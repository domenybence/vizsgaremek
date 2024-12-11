function createCompiler(container) {
    require.config({ paths: { "vs": "https://cdnjs.cloudflare.com/ajax/libs/monaco-editor/0.34.1/min/vs" } });
    require(["vs/editor/editor.main"], function () {
        monaco.editor.setTheme("vs-dark");
        let editor = monaco.editor.create(document.getElementById(container), {
            value: `<div class="title-group upvote-wrapper">
                        <div class="title-item svg-like-wrapper">
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" 
                                class="bi bi-arrow-up-circle like-svg like-svg-empty" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8m15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-7.5 3.5a.5.5 0 0 1-1 0V5.707L5.354 7.854a.5.5 0 1 1-.708-.708l3-3a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 5.707z"/>
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" 
                                class="bi bi-arrow-up-circle-fill like-svg like-svg-full" viewBox="0 0 16 16">
                                <path d="M16 8A8 8 0 1 0 0 8a8 8 0 0 0 16 0m-7.5 3.5a.5.5 0 0 1-1 0V5.707L5.354 7.854a.5.5 0 1 1-.708-.708l3-3a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 5.707z"/>
                            </svg>
                        </div>
                        <div class="title-item">
                            <p>130</p>
                        </div>
                        <div class="title-item svg-dislike-wrapper">
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-arrow-down-circle dislike-svg-empty" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8m15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8.5 4.5a.5.5 0 0 0-1 0v5.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293z"/>
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-arrow-down-circle-fill dislike-svg-full" viewBox="0 0 16 16">
                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8.5 4.5a.5.5 0 0 0-1 0v5.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293z"/>
                            </svg>
                        </div>
                    </div>`,
            language: "html",
            fontSize: 20,
            readOnly: true
        });
        function adjustFontSize() {
            if (window.matchMedia("(min-width: 1024px)").matches) {
                editor.updateOptions({ fontSize: 20 });
            }
            else if (window.matchMedia("(min-device-width: 768px) and (max-device-width: 1024px)").matches) {
                editor.updateOptions({ fontSize: 20 });
            }
            else if (window.matchMedia("(max-device-width: 480px) and (orientation: portrait)").matches) {
                editor.updateOptions({ fontSize: 20 });
            }
            else if (window.matchMedia("(max-device-width: 640px) and (orientation: landscape)").matches) {
                editor.updateOptions({ fontSize: 18 });
            }
            else if (window.matchMedia("(max-device-width: 640px)").matches) {
                editor.updateOptions({ fontSize: 16 });
            }
            else if (window.matchMedia("(min-device-width: 320px) and (-webkit-min-device-pixel-ratio: 2)").matches) {
                editor.updateOptions({ fontSize: 16 });
            }
            else if (window.matchMedia("(device-height: 568px) and (device-width: 320px) and (-webkit-min-device-pixel-ratio: 2)").matches) {
                editor.updateOptions({ fontSize: 16 });
            }
            else if (window.matchMedia("(min-device-height: 667px) and (min-device-width: 375px) and (-webkit-min-device-pixel-ratio: 3)").matches) {
                editor.updateOptions({ fontSize: 16 });
            }
            else {
                editor.updateOptions({ fontSize: 16 });
            }
        }
        const mediaQueries = [
            "(min-width: 1024px)",
            "(min-device-width: 768px) and (max-device-width: 1024px)",
            "(max-device-width: 480px) and (orientation: portrait)",
            "(max-device-width: 640px) and (orientation: landscape)",
            "(max-device-width: 640px)",
            "(min-device-width: 320px) and (-webkit-min-device-pixel-ratio: 2)",
            "(device-height: 568px) and (device-width: 320px) and (-webkit-min-device-pixel-ratio: 2)",
            "(min-device-height: 667px) and (min-device-width: 375px) and (-webkit-min-device-pixel-ratio: 3)"
        ];
        for (const mediaquery of mediaQueries) {
            const mediaQuery = window.matchMedia(mediaquery);
            mediaQuery.addEventListener("change", adjustFontSize);
        }
        adjustFontSize();
        function adjustEditorSize() {
            editor.layout();
        }
        window.addEventListener("resize", adjustEditorSize);
    });
}
