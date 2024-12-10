function createCompiler(container) {
    require.config({ paths: { "vs": "https://cdnjs.cloudflare.com/ajax/libs/monaco-editor/0.34.1/min/vs" } });
    require(["vs/editor/editor.main"], function () {
        monaco.editor.setTheme("vs-dark");
        let editor = monaco.editor.create(document.getElementById(container), {
            value: `<div class="title-wrapper">
            <div class="title-item-wrapper">
                <div class="title-group">
                    <div class="title-item">Feltöltő</div>
                    <div class="title-item">domebence</div>
                </div>
                <hr>
                <div class="title-group">
                    <div class="title-item">Kód neve</div>
                    <div class="title-item">Teszt kódnév</div>
                </div>
                <hr>
                <div class="title-group">
                    <div class="title-item">Kategóriák</div>
                    <div class="title-item">HTML, JavaScript, PHP</div>
                </div>
                <hr>
                <div class="title-group">
                    <div class="title-item">Feltöltés ideje</div>
                    <div class="title-item">2024.12.05.</div>
                </div>
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
