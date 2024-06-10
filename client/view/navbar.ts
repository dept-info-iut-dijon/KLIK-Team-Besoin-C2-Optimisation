export class Navbar{

    public static GenerateNavbar(divName: string): void{
        //get main content div
        const mainDiv: HTMLDivElement = document.getElementById(divName) as HTMLDivElement;
        
        //generate nav
        const nav: HTMLElement = document.createElement("nav");
        nav.classList.add("navbar", "sticky-top", "navbar-expand-md", "navbar-light", "bg-light");
        
        //generate logo button
        const logoLink: HTMLAnchorElement = document.createElement("a");
        logoLink.classList.add("navbar-brand");
        logoLink.href = "index.html";
        const logoLinkImg: HTMLImageElement = document.createElement("img");
        logoLinkImg.src = "./src/img/200.png";
        logoLinkImg.width = 40;
        logoLinkImg.height = 40;
        logoLink.appendChild(logoLinkImg);
        nav.appendChild(logoLink);
        
        //generate navbar toggler
        const navbarTogglerButton: HTMLButtonElement = document.createElement("button");
        navbarTogglerButton.classList.add("navbar-toggler");
        navbarTogglerButton.type = "button";
        navbarTogglerButton.setAttribute("data-toggle", "collapse");
        navbarTogglerButton.setAttribute("data-target", "#navbarSupportedContent");
        navbarTogglerButton.setAttribute("aria-controls", "navbarSupportedContent");
        navbarTogglerButton.setAttribute("aria-expanded", "false");
        navbarTogglerButton.setAttribute("aria-label", "Toggle navigation");
        const navbarTogglerSpan: HTMLSpanElement = document.createElement("span");
        navbarTogglerSpan.classList.add("navbar-toggler-icon");
        navbarTogglerButton.appendChild(navbarTogglerSpan);
        nav.appendChild(navbarTogglerButton);

        //generate navbar collapse div
        const collapseDiv: HTMLDivElement = document.createElement("div");
        collapseDiv.classList.add("collapse", "navbar-collapse", "justify-content-right");
        collapseDiv.id = "navbarSupportedContent";
        nav.appendChild(collapseDiv);

        //generate nav ul
        const ul: HTMLUListElement = document.createElement("ul");
        ul.classList.add("navbar-nav", "ml-auto", "mr-1");
        collapseDiv.appendChild(ul);

        //item 1 : dashboard
        /*
        const ulItem1: HTMLLIElement = document.createElement("li");
        ulItem1.classList.add("nav-item", "px-3");
        ul.appendChild(ulItem1);
        const aItem1: HTMLAnchorElement = document.createElement("a");
        aItem1.classList.add("nav-link");
        aItem1.href = "index.html";
        ulItem1.appendChild(aItem1);
        const iconItem1: HTMLElement = document.createElement("i");
        iconItem1.classList.add("fa", "fa-bar-chart", "fa-2x");
        iconItem1.setAttribute("aria-hidden", "true");
        aItem1.appendChild(iconItem1);
        */

        //item 2 : github
        const ulItem2: HTMLLIElement = document.createElement("li");
        ulItem2.classList.add("nav-item", "px-3");
        ul.appendChild(ulItem2);
        const aItem2: HTMLAnchorElement = document.createElement("a");
        aItem2.classList.add("nav-link");
        aItem2.href = "https://github.com/msaad1999/KLiK--PHP-coded-Social-Media-Website";
        ulItem2.appendChild(aItem2);
        const iconItem2: HTMLElement = document.createElement("i");
        iconItem2.classList.add("fa", "fa-github", "fa-2x");
        iconItem2.setAttribute("aria-hidden", "true");
        aItem2.appendChild(iconItem2);

        //item 3 : messages
        const ulItem3: HTMLLIElement = document.createElement("li");
        ulItem3.classList.add("nav-item", "px-3");
        ul.appendChild(ulItem3);
        const aItem3: HTMLAnchorElement = document.createElement("a");
        aItem3.classList.add("nav-link");
        aItem3.href = "message.html";
        ulItem3.appendChild(aItem3);
        const iconItem3: HTMLElement = document.createElement("i");
        iconItem3.classList.add("fa", "fa-envelope", "fa-2x");
        iconItem3.setAttribute("aria-hidden", "true");
        aItem3.appendChild(iconItem3);

        //item 4 : users
        const ulItem4: HTMLLIElement = document.createElement("li");
        ulItem4.classList.add("nav-item", "px-3");
        ul.appendChild(ulItem4);
        const aItem4: HTMLAnchorElement = document.createElement("a");
        aItem4.classList.add("nav-link");
        aItem4.href = "users-view.html";
        ulItem4.appendChild(aItem4);
        const iconItem4: HTMLElement = document.createElement("i");
        iconItem4.classList.add("fa", "fa-users", "fa-2x");
        iconItem4.setAttribute("aria-hidden", "true");
        aItem4.appendChild(iconItem4);

        //item 5 : settings dropdown
        const ulItem5: HTMLLIElement = document.createElement("li");
        ulItem5.classList.add("nav-item", "dropdown", "px-3");
        ul.appendChild(ulItem5);

        const dropDownToggle: HTMLAnchorElement = document.createElement("a");
        dropDownToggle.classList.add("nav-link", "dropdown-toggle");
        dropDownToggle.href="#";
        dropDownToggle.id="navbarDropDown";
        dropDownToggle.role="button";
        dropDownToggle.setAttribute("data-toggle", "dropdown");
        dropDownToggle.setAttribute("aria-haspopup", "true");
        dropDownToggle.setAttribute("aria-expanded", "false");
        ulItem5.appendChild(dropDownToggle);

        const iconItem5: HTMLElement = document.createElement("i");
        iconItem5.classList.add("fa", "fa-cog", "fa-2x");
        iconItem5.setAttribute("aria-hidden", "true");
        dropDownToggle.appendChild(iconItem5);

        const dropDownMenu: HTMLDivElement = document.createElement("div");
        dropDownMenu.classList.add("dropdown-menu");
        dropDownMenu.setAttribute("aria-labelledby", "navbarDropDown");
        ulItem5.appendChild(dropDownMenu);

        const dropDownMenuItem1: HTMLAnchorElement = document.createElement("a");
        dropDownMenuItem1.classList.add("dropdown-item");
        dropDownMenuItem1.href="profile.html";
        dropDownMenuItem1.textContent = "My Profile";
        dropDownMenu.appendChild(dropDownMenuItem1);

        const dropDownMenuItem2: HTMLAnchorElement = document.createElement("a");
        dropDownMenuItem2.classList.add("dropdown-item");
        dropDownMenuItem2.href="edit-profile.html";
        dropDownMenuItem2.textContent = "Edit Profile";
        dropDownMenu.appendChild(dropDownMenuItem2);
        
        const divider: HTMLDivElement = document.createElement("div");
        divider.classList.add("dropdown-divider");
        dropDownMenu.appendChild(divider);

        const dropDownMenuItem3: HTMLAnchorElement = document.createElement("a");
        dropDownMenuItem3.classList.add("dropdown-item");
        dropDownMenuItem3.href="users-view.html";
        dropDownMenuItem3.textContent = "Find People";
        dropDownMenu.appendChild(dropDownMenuItem3);

        const dropDownMenuItem4: HTMLAnchorElement = document.createElement("a");
        dropDownMenuItem4.classList.add("dropdown-item");
        dropDownMenuItem4.href="contact.html";
        dropDownMenuItem4.textContent = "Contact us";
        dropDownMenu.appendChild(dropDownMenuItem4);

        //item 6 : logout
        const ulItem6: HTMLLIElement = document.createElement("li");
        ulItem6.classList.add("nav-item", "px-3");
        ul.appendChild(ulItem6);
        const aItem6: HTMLAnchorElement = document.createElement("a");
        aItem6.classList.add("nav-link");
        aItem6.href = "login.html"; // A MODIFIER QUAND LOGOUT IMPLEMENTE
        ulItem6.appendChild(aItem6);
        const iconItem6: HTMLElement = document.createElement("i");
        iconItem6.classList.add("fa", "fa-sign-out", "fa-2x");
        iconItem6.setAttribute("aria-hidden", "true");
        aItem6.appendChild(iconItem6);

        //add nav at beginning of content
        mainDiv.insertAdjacentElement("afterbegin", nav);
    }
}