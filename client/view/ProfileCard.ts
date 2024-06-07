export class ProfileCard{
    public static GenerateProfileCard(divName: string): void{

        //GET USER INFO
        const userImg: string = "./uploads/default.png";
        const userLevel: number = 1;
        const username: string = "jdoe";
        const userFirstName: string = "John";
        const userLastName: string = "Doe";
        const userHeadline: string = "This is a headline";

        //generate main profile card div
        const mainDiv: HTMLDivElement = document.getElementById(divName) as HTMLDivElement;
        const profileCardDiv: HTMLDivElement = document.createElement("div");
        profileCardDiv.classList.add("card", "card-profile", "text-center");
        mainDiv.insertAdjacentElement("afterbegin", profileCardDiv);

        //user cover image
        const userCover: HTMLImageElement = document.createElement("img");
        userCover.alt = "";
        userCover.classList.add("card-img-top", "card-user-cover");
        userCover.src="./img/user-cover.png";
        profileCardDiv.appendChild(userCover);

        //card block
        const cardBlock: HTMLDivElement = document.createElement("div");
        cardBlock.classList.add("card-block");
        profileCardDiv.appendChild(cardBlock);

        //profile picture
        const profilePictureLink: HTMLAnchorElement = document.createElement("a");
        profilePictureLink.href="profile.html";
        cardBlock.appendChild(profilePictureLink);
        const profilePictureImage: HTMLImageElement = document.createElement("img");
        profilePictureImage.src=userImg;
        profilePictureImage.classList.add("card-img-profile");
        profilePictureLink.appendChild(profilePictureImage);

        //admin badge
        if(userLevel == 1){
            const adminBadge: HTMLImageElement = document.createElement("img");
            adminBadge.id="card-admin-badge";
            adminBadge.src="./img/admin-badge.png";
            cardBlock.appendChild(adminBadge);
        }

        //edit profile icon
        const editProfileLink: HTMLAnchorElement = document.createElement("a");
        editProfileLink.href="edit-profile.html";
        cardBlock.appendChild(editProfileLink);
        const editProfileIcon: HTMLElement = document.createElement("i");
        editProfileIcon.classList.add("fa", "fa-pencil", "fa-2x", "edit-profile");
        editProfileIcon.setAttribute("aria-hidden", "true");
        editProfileLink.appendChild(editProfileIcon);

        //card title
        const cardTitle: HTMLHeadingElement = document.createElement("h4");
        cardTitle.classList.add("card-title");
        cardBlock.appendChild(cardTitle);
        const userNameP = document.createElement("p");
        userNameP.textContent = username;
        cardTitle.appendChild(userNameP);
        const firstNameLastName: HTMLElement = document.createElement("small");
        firstNameLastName.classList.add("text-muted");
        firstNameLastName.textContent = `${userFirstName} ${userLastName}`;
        cardTitle.appendChild(firstNameLastName);
        const br1 = document.createElement("br");
        cardTitle.appendChild(br1);
        const headline: HTMLElement = document.createElement("small");
        headline.classList.add("text-muted");
        headline.textContent = userHeadline;
        cardTitle.appendChild(headline);
        const br2 = document.createElement("br");
        cardTitle.appendChild(br2);
        const br3 = document.createElement("br")
        cardTitle.appendChild(br3);
        const br4 = document.createElement("br")
        cardTitle.appendChild(br4);
    }
}