import { SignupView } from "../view/SignupView.js";
window.onload = () => {
    const imgBlah = document.getElementById("blah");
    imgBlah.setAttribute('src', './img/default.png');
    function readURL(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function (e) {
                const result = e.target.result;
                imgBlah.setAttribute('src', result);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
    document.getElementById('imgInp').addEventListener('change', function () {
        readURL(this);
    });
    new SignupView();
};
