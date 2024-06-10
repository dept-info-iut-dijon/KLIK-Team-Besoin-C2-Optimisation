var __awaiter = (this && this.__awaiter) || function (thisArg, _arguments, P, generator) {
    function adopt(value) { return value instanceof P ? value : new P(function (resolve) { resolve(value); }); }
    return new (P || (P = Promise))(function (resolve, reject) {
        function fulfilled(value) { try { step(generator.next(value)); } catch (e) { reject(e); } }
        function rejected(value) { try { step(generator["throw"](value)); } catch (e) { reject(e); } }
        function step(result) { result.done ? resolve(result.value) : adopt(result.value).then(fulfilled, rejected); }
        step((generator = generator.apply(thisArg, _arguments || [])).next());
    });
};
import BlogController from "../controller/BlogController.js";
import { ProfileCard } from "./ProfileCard.js";
import { Navbar } from "./navbar.js";
export class MainView {
    constructor() {
        this.blogController = new BlogController();
        Navbar.GenerateNavbar("content");
        ProfileCard.GenerateProfileCard("profileCard");
        document.title = "Dashboard | KliK";
        this.generateBlogs();
    }
    generateBlogCard(blog) {
        //create div
        const div = document.createElement("div");
        div.classList.add("col-md-6");
        //create card
        const card = document.createElement("div");
        card.classList.add("card", "flex-md-row", "mb-4", "shadow-sm", "h-md-250");
        div.appendChild(card);
        //create card body
        const cardBody = document.createElement("div");
        cardBody.classList.add("card-body", "d-flex", "flex-column", "align-items-start");
        card.append(cardBody);
        //votes
        const blogVotes = document.createElement("strong");
        blogVotes.classList.add("d-inline-block", "mb-2", "text-primary");
        cardBody.append(blogVotes);
        const blogIcon = document.createElement("i");
        blogIcon.classList.add("fa", "fa-thumbs-up");
        blogIcon.setAttribute("aria-hidden", "true");
        blogVotes.appendChild(blogIcon);
        const blogVotesCount = document.createTextNode(blog.BlogVotes.length.toString());
        blogIcon.after(blogVotesCount);
        //title
        const header = document.createElement("h6");
        header.classList.add("mb-0");
        cardBody.appendChild(header);
        const titleLink = document.createElement("a");
        titleLink.classList.add("text-dark");
        titleLink.href = "blog-page.html";
        titleLink.textContent = blog.BlogTitle.slice(0, 10);
        header.appendChild(titleLink);
        //date
        const date = document.createElement("small");
        date.classList.add("mb-1", "text-muted");
        date.textContent = blog.BlogDate.toLocaleDateString();
        cardBody.appendChild(date);
        //content
        const content = document.createElement("small");
        content.classList.add("card-text", "mb-auto");
        content.textContent = blog.BlogContent.slice(0, 40) + '...';
        cardBody.appendChild(content);
        //continue reading button
        const continueReading = document.createElement("a");
        continueReading.href = "blog-page.html";
        continueReading.textContent = "Continue reading";
        cardBody.appendChild(content);
        //card Image
        const cardImageLink = document.createElement("a");
        cardImageLink.href = "blog-page.html";
        card.appendChild(cardImageLink);
        const cardImageImg = document.createElement("img");
        cardImageImg.classList.add("card-img-right", "flex-auto", "d-none", "d-lg-block", "blogindex-cover");
        cardImageImg.src = `./src/uploads/${blog.BlogImg}`;
        cardImageLink.appendChild(cardImageImg);
        return div;
    }
    generateBlogs() {
        return __awaiter(this, void 0, void 0, function* () {
            const blogs = yield this.blogController.getAllBlogs();
            const blogTab = document.getElementById("blogTab");
            blogs.forEach(blog => {
                const div = this.generateBlogCard(blog);
                blogTab.appendChild(div);
            });
        });
    }
}
