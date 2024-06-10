export class Category {
    get CatId() {
        return this.catId;
    }
    set CatId(value) {
        this.catId = value;
    }
    get CatName() {
        return this.catName;
    }
    set CatName(value) {
        this.catName = value;
    }
    get CatDescription() {
        return this.catDescription;
    }
    set CatDescription(value) {
        this.catDescription = value;
    }
    constructor() {
        this.catId = 0;
        this.catName = "";
        this.catDescription = "";
    }
    static createFromObject(obj) {
        const category = new Category();
        category.CatId = obj.catId || 0;
        category.CatName = obj.catName || "";
        category.CatDescription = obj.catDescription || "";
        return category;
    }
}
