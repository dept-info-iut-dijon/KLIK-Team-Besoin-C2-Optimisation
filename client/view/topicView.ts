import{ Post } from "../model/post.js";
import{ User } from "../model/user.js";
import{ Topic } from "../model/topic.js";
import{ PostVote } from "../model/postVote.js";

export class TopicView {

    private topic : Topic;
    private divPosts : HTMLDivElement;

    constructor(){

        this.topic = Topic.createFromObject(sessionStorage.getItem('topic'));

        this.divPosts = document.getElementById("divPosts") as HTMLDivElement;

        const postsHTML = this.generatePostsHTML(this.topic.TopicPosts);
       
        this.divPosts.innerHTML = postsHTML;
    }

    public generatePostHTML(post: Post): string {
        const user = post.PostUser;
        const votes = post.PostVotes.reduce((acc, vote) => acc + vote.PostVote, 0);

        return `
            <div class="post">
                <div class="post-header">
                    <div class="user-info">
                        <img src="${user.UserImage}" alt="${user.Username}" class="user-avatar">
                        <div class="user-details">
                            <div class="username">${user.Username}</div>
                            <div class="joined-date">Joined: ${new Date(user.UserBio).toDateString()}</div>
                            <div class="messages-count">Messages: ${user.UserLevel}</div>
                            <div class="likes-count">Likes: ${votes}</div>
                        </div>
                    </div>
                    <div class="post-date">${post.PostDate.toDateString()}</div>
                </div>
                <div class="post-content">
                    ${post.PostContent}
                </div>
                <div class="post-votes">
                    <span class="votes-count">${votes}</span>
                </div>
            </div>
        `;
    }

    public generatePostsHTML(posts: Array<Post>): string {
        return posts.map(post => this.generatePostHTML(post)).join("");
    }
}

