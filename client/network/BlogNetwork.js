var __awaiter = (this && this.__awaiter) || function (thisArg, _arguments, P, generator) {
    function adopt(value) { return value instanceof P ? value : new P(function (resolve) { resolve(value); }); }
    return new (P || (P = Promise))(function (resolve, reject) {
        function fulfilled(value) { try { step(generator.next(value)); } catch (e) { reject(e); } }
        function rejected(value) { try { step(generator["throw"](value)); } catch (e) { reject(e); } }
        function step(result) { result.done ? resolve(result.value) : adopt(result.value).then(fulfilled, rejected); }
        step((generator = generator.apply(thisArg, _arguments || [])).next());
    });
};
import { Blog } from "../model/blog.js";
export default class BlogNetwork {
    createBlog(blog) {
        return __awaiter(this, void 0, void 0, function* () {
            try {
                const response = yield fetch(`../serveur/controller/blogController.php?action=create`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(blog),
                });
                if (!response.ok) {
                    throw new Error(`Bad response from server: ${response.status}`);
                }
                const result = yield response.json();
                console.log('Created blog:', result);
                return true;
            }
            catch (error) {
                console.error('Error when creating blog: ' + error.message);
                return false;
            }
        });
    }
    updateBlog(blog) {
        return __awaiter(this, void 0, void 0, function* () {
            try {
                const response = yield fetch('../serveur/controller/blogController.php?action=update', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(blog),
                });
                if (!response.ok) {
                    throw new Error(`Bad response from server: ${response.status}`);
                }
                const result = yield response.json();
                console.log('Updated blog :', result);
                return true;
            }
            catch (error) {
                console.error('Error when updating blogs: ' + error.message);
                return false;
            }
        });
    }
    getAllBlogs() {
        return __awaiter(this, void 0, void 0, function* () {
            let result = new Array();
            try {
                const response = yield fetch(`../serveur/controller/blogController.php?action=all`);
                if (!response.ok) {
                    throw new Error(`Bad response from server: ${response.status}`);
                }
                const json = yield response.json();
                result = json.map((obj) => Blog.createFromObject(obj));
            }
            catch (error) {
                console.error('Error when getting blogs: ' + error.message);
            }
            return result;
        });
    }
}
