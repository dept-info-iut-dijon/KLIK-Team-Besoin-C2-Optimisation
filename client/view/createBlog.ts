class Blog {
    private blog_title: HTMLInputElement;
    private blog_img: HTMLInputElement;
    private blog_date: HTMLInputElement;
    private blog_content: HTMLTextAreaElement;
    private errorMessage: HTMLDivElement;

    constructor() {
        this.blog_title = document.getElementById('blog_title') as HTMLInputElement;
        this.blog_img = document.getElementById('blog_img') as HTMLInputElement;
        this.blog_date = document.getElementById('blog_date') as HTMLInputElement;
        this.blog_content = document.getElementById('blog_content') as HTMLTextAreaElement;
        this.errorMessage = document.getElementById('errorField') as HTMLDivElement;

        document.getElementById('blogForm')!.addEventListener('submit', (event) => this.submit(event));
    }



    private async submit(event: Event){

        this.errorMessage.innerHTML = "";
        this.errorMessage.setAttribute("class", "");

        const blogTitle: string = this.blog_title.value;
        const blogDate: string = this.blog_date.value;
        const blogContent: string = this.blog_content.value;

        let file: File | null = null;
        if(this.blog_img.files && this.blog_img.files[0]){
            file = this.blog_img.files[0];
        }

        const blog = {
            BlogTitle:this.blog_title,
            BlogImg: file ? URL.createObjectURL(file) : "",
            BlogDate: this.blog_date,
            BlogContent:this.blog_content
        };

        try{
            const formData: FormData = new FormData();

            if(file){
                formData.append("blog_img", file);
            }
            formData.append("blog", JSON.stringify(blog));

            const response = await fetch('http://localhost/serveur/controller/blogController.php?action=create', {
                method: 'POST',
                body: formData,
            });

            if(!response.ok){
                throw new Error("Aucune réponse du serveur")
            }

            const result = await response.json();

            console.log('Blog créé:', result);

        } catch(error : any){
            this.sendError('Erreur lors de la création du Blog' + error.message)
        }


        new Blog();

        

        

    }







    private sendError(message:string){
        this.errorMessage.setAttribute("class", "alert alert-danger");
        this.errorMessage.innerHTML = message;
    }

}

