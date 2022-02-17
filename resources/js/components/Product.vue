<template>
    <div class="row">
        <div class="col-lg-8 col-sm-12 mb-5">
            <div class="bg-white shadow-sm rounded-lg border p-4">
                <form action="" @submit.prevent="submitForm">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">{{transTitle.title}}<span class="required"></span></label>
                        <div class="col-sm-9">
                            <input type="text" maxlength="50" class="form-control" v-model="title">
                            <small class="form-text text-muted">
                                <font style="vertical-align: inherit;">
                                        Tiêu đề không được lớn hơn 50 ký tự.
                                </font>
                                <p class="text-danger">{{getFirstError('title')}}</p>
                            </small>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">{{transTitle.description}}<span class="required"></span></label>
                        <div class="col-sm-9">
                            <textarea name="content" id="content" class="form-control" v-model="description"></textarea>
                            <small class="form-text text-muted">
                                <font style="vertical-align: inherit;">
                                        Tiêu đề không được lớn hơn 2500 ký tự.
                                </font>
                                <p class="text-danger">{{getFirstError('description')}}</p>
                            </small>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">{{transProduct.title.category}}<span class="required"></span></label>
                        <div class="col-sm-9">
                            <!-- <input type="text" maxlength="50" class="form-control"> -->
                            <select
                                class="form-control m-width-205"
                                name="language"
                                v-model="category_id"
                            >
                                <option
                                    :value="id"
                                    v-for="(nameCategory, id) in categoryList"
                                    :key="id"
                                >
                                    {{ nameCategory }}
                                </option>
                            </select>
                            <small class="form-text text-muted">
                                <!-- <font style="vertical-align: inherit;">
                                </font> -->
                                <p class="text-danger">{{getFirstError('category_id')}}</p>

                            </small>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">{{transTitle.price}}<span class="required"></span></label>
                        <div class="col-sm-9">
                            <input type="number" maxlength="50" class="form-control" v-model="price">
                            <small class="form-text text-muted">
                                <font style="vertical-align: inherit;">
                                        Đơn vị tiền tệ là VNĐ.
                                </font>
                                <p class="text-danger">{{getFirstError('price')}}</p>
                            </small>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">{{transProduct.title.images}}<span class="required"></span></label>
                        <div class="col-sm-9">
                            <div class="row">
                                <div class="col-12">
                                    <label
                                        for="uploadFile"
                                        class="btn  bg-primary text-white"
                                        id="labelBrandImg"
                                        role="button"
                                    >
                                    Upload
                                    </label>
                                    <input
                                        name="image"
                                        id="uploadFile"
                                        type="file"
                                        class="input-file image"
                                        accept="image/*"
                                        multiple
                                        @change="updateImage"
                                    />
                                </div>
                                <div class="col-12">
                                    <div class="btn-upload" v-for="(image, key) of images" :key="key">
                                            <img height="100%" :src="image" class="" :id="'markerImage_' + key" /> 
                                            <a role="button" class="btn-remove-image text-danger" @click="remoeImage(key)">
                                                <i class="fas fa-minus-circle fa-lg"></i>
                                            </a>
                                    </div>
                                </div>
                            </div>
                            <small class="form-text text-muted">
                                <!-- <font style="vertical-align: inherit;">
                                </font> -->
                                <p class="text-danger">{{getFirstError('images')}}</p>

                            </small>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Kích hoạt<span class="required"></span></label>
                        <div class="col-sm-9">
                            <div class="custom-control custom-switch ">
                                <input
                                    id="switch-show-use-coupon"
                                    type="checkbox"
                                    class="custom-control-input "
                                    v-model="active"
                                    true-value=1
                                    false-value=0
                                    :checked = "active"
                                >
                                <label class="custom-control-label" for="switch-show-use-coupon"></label>
                            </div>
                            <small class="form-text text-muted">

                                <p class="text-danger">{{getFirstError('active')}}</p>

                            </small>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn bg-primary text-white" :disabled="isDisabled">{{ isEdit ? transBtn.edit : transBtn.create}}</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- preview -->
        <!-- <div class="col-lg-4 col-sm-12 mb-5">
            <div class="position-sticky card" style="top:5px;">
                <div class="card-header">
                    <h3 class="card-title">preview</h3>
                </div>
                <div class="card-body p-0">
                </div>
            </div>
        </div> -->
    </div>
</template>
 
<script>
export default {
    props: {
        categoryList: {
            type: Object,
            require: true,
        },

        formAction: {
            type: String,
            require: true,
        },
        productData: {
            type: Object,
            default: null,
        },
        isEdit: {
            type: Boolean,
            default: false
        },
        transProduct: {
            type: Object,
            require: true,
        },
        transBtn: {
            type: Object,
            require: true,
        },
        transTitle: {
            type: Object,
            require: true,
        }
    },
    data() {
        return {
            category_id: null,
            title: "",
            images: [],
            description: "",
            price: null,
            active: 0,
            validationErrors: {},
            isDisabled: false,
            remove_old_img:[],
        };
    },
    methods: {
        submitForm() {
            this.isDisabled = true,
            axios.post(this.formAction, this.prepareFormData())
            .then((res) => {
                console.log(res.data);
                window.location.replace(res.data.redirect)
            })
            .catch((error) => {
                this.isDisabled = false,
                error.response.status == 422 && (this.validationErrors = error.response.data.errors);
                console.log(this.validationErrors.category_id);

            })
        },

        prepareFormData() {
            let data = new FormData;
            data.append('category_id', this.category_id);
            data.append('title', this.title);
            data.append('description', this.description);
            data.append('price', this.price);
            data.append('active', this.active == 1 ? 1 : 0);
            console.log('typeof', typeof this.active);

            for (let images = this.images.length, i = 0; i < images; i++) {
                let image = this.images[i];
                this.isEdit && typeof image == 'string' || data.append("images[" + i + "]", image);
            }
            if (this.isEdit) {
                data.append("_method", "PUT");
                data.append("remove_old_img", JSON.stringify(this.remove_old_img));
            }
            return data;
        },

        fetchProductData() {
            let data = this.productData;
            this.title = data.title;
            this.description = data.description;
            this.price = data.price;
            this.active = data.active;
            this.images = data.images;
            this.category_id = data.category_id;
        },

        updateImage(e) {
            let selectedFiles = e.target.files;
            for (let i=0; i < selectedFiles.length; i++){
                if (!selectedFiles[i].type.match(/.(jpg|jpeg|png|svg\+xml)$/i)) {
                    alert("File is invalid, allowed extensions are: jpg, jpeg, png, svg");
                    continue;
                }
                this.images.push(selectedFiles[i]);
            }
            this.preview();
        },

        preview() {
            console.log(this.images);
            for (var i=0; i<this.images.length; i++){
                if (!(this.images[i] instanceof File) ||!(this.images[i] instanceof Blob)) {
                    continue
                }
                let reader = new FileReader();
                let id = 'markerImage_' +  i ;
                reader.onload = function (e) {
                    const selector = document.getElementById(id)
                    selector.src = e.target.result
                }
                reader.readAsDataURL(this.images[i])
            }
        },

        remoeImage(key) {
            let image = this.images[key];
            this.isEdit && typeof image == "string" && this.remove_old_img.push(image.replace('/storage/images/', '')),
            this.images.splice(key, 1)
            this.preview();
            document.getElementById("uploadFile").value = "";
        },
        getFirstError(params) {
            if (this.validationErrors) {
                for (let error in this.validationErrors) {
                    if (error == params)
                        return this.validationErrors[error][0];
                }
            }
        }
    },
    created() {
        this.isEdit && this.fetchProductData();
    }
}
</script>
<style>
    .btn-upload {
        display: inline-block;
        height: 100px;
        position: relative;
        z-index: 1;
        padding-right: 5px;
        padding-bottom: 5px;
        margin-right: 10px;
    }
    .btn-remove-image {
        position: absolute;
        top: -5%;
        left: 85%;
    }
    .input-file {
        display: none !important;
    }
</style>