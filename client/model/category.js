"use strict";
Object.defineProperty(exports, "__esModule", { value: true });
exports.Category = void 0;
class Category {
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
}
exports.Category = Category;
