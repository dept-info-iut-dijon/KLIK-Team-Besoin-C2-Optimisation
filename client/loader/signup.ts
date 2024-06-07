import {SignupView} from "../view/SignupView.js";

window.onload = () => {
    const imgBlah = document.getElementById("blah") as HTMLImageElement;
    imgBlah.setAttribute('src', './img/default.png');

    function readURL(input: HTMLInputElement): void {
        if (input.files && input.files[0]) {
            const reader = new FileReader();

            reader.onload = function(e: ProgressEvent<FileReader>) {
                const result = e.target!.result as string;
                imgBlah.setAttribute('src', result);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }

    document.getElementById('imgInp')!.addEventListener('change', function(this: HTMLInputElement) {
        readURL(this);
    });

    new SignupView();
}