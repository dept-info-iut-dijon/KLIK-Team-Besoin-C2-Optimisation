export class Category {
    private catId: number;
    private catName: string;
    private catDescription: string;

    public get CatId(): number {
        return this.catId;
    }

    public set CatId(value: number) {
        this.catId = value;
    }

    public get CatName(): string {
        return this.catName;
    }

    public set CatName(value: string) {
        this.catName = value;
    }

    public get CatDescription(): string {
        return this.catDescription;
    }

    public set CatDescription(value: string) {
        this.catDescription = value;
    }

    constructor() {
        this.catId = 0;
        this.catName = "";
        this.catDescription = "";
    }
}