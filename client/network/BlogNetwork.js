var __awaiter = (this && this.__awaiter) || function (thisArg, _arguments, P, generator) {
    function adopt(value) { return value instanceof P ? value : new P(function (resolve) { resolve(value); }); }
    return new (P || (P = Promise))(function (resolve, reject) {
        function fulfilled(value) { try { step(generator.next(value)); } catch (e) { reject(e); } }
        function rejected(value) { try { step(generator["throw"](value)); } catch (e) { reject(e); } }
        function step(result) { result.done ? resolve(result.value) : adopt(result.value).then(fulfilled, rejected); }
        step((generator = generator.apply(thisArg, _arguments || [])).next());
    });
};
export default class BlogNetwork {
    createBlog(blog) {
        return __awaiter(this, void 0, void 0, function* () {
            try {
                const response = yield fetch('http://localhost/serveur/controller/blogController.php?action=create', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(blog),
                });
                if (!response.ok) {
                    throw new Error("Aucune réponse du serveur");
                }
                const result = yield response.json();
                console.log('Blog créé :', result);
                return true;
            }
            catch (error) {
                console.error('Erreur lors de la création du Blog : ' + error.message);
                return false;
            }
        });
    }
}
