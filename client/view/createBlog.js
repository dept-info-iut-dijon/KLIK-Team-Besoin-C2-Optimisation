"use strict";
var __awaiter = (this && this.__awaiter) || function (thisArg, _arguments, P, generator) {
    function adopt(value) { return value instanceof P ? value : new P(function (resolve) { resolve(value); }); }
    return new (P || (P = Promise))(function (resolve, reject) {
        function fulfilled(value) { try { step(generator.next(value)); } catch (e) { reject(e); } }
        function rejected(value) { try { step(generator["throw"](value)); } catch (e) { reject(e); } }
        function step(result) { result.done ? resolve(result.value) : adopt(result.value).then(fulfilled, rejected); }
        step((generator = generator.apply(thisArg, _arguments || [])).next());
    });
};
class Blog {
    constructor() {
        this.blog_title = document.getElementById('blog_title');
        this.blog_img = document.getElementById('blog_img');
        this.blog_date = document.getElementById('blog_date');
        this.blog_content = document.getElementById('blog_content');
        this.errorMessage = document.getElementById('errorField');
        document.getElementById('blogForm').addEventListener('submit', (event) => this.submit(event));
    }
    submit(event) {
        return __awaiter(this, void 0, void 0, function* () {
            this.errorMessage.innerHTML = "";
            this.errorMessage.setAttribute("class", "");
            const blogTitle = this.blog_title.value;
            const blogDate = this.blog_date.value;
            const blogContent = this.blog_content.value;
            let file = null;
            if (this.blog_img.files && this.blog_img.files[0]) {
                file = this.blog_img.files[0];
            }
            const blog = {
                BlogTitle: this.blog_title,
                BlogImg: file ? URL.createObjectURL(file) : "",
                BlogDate: this.blog_date,
                BlogContent: this.blog_content
            };
            try {
                const formData = new FormData();
                if (file) {
                    formData.append("blog_img", file);
                }
                formData.append("blog", JSON.stringify(blog));
                const response = yield fetch('http://localhost/serveur/controller/blogController.php?action=create', {
                    method: 'POST',
                    body: formData,
                });
                if (!response.ok) {
                    throw new Error("Aucune réponse du serveur");
                }
                const result = yield response.json();
                console.log('Blog créé:', result);
            }
            catch (error) {
                this.sendError('Erreur lors de la création du Blog' + error.message);
            }
            new Blog();
        });
    }
    sendError(message) {
        this.errorMessage.setAttribute("class", "alert alert-danger");
        this.errorMessage.innerHTML = message;
    }
}
