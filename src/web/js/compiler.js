function createCompiler(container, readOnly = true){
    require.config({ paths: { "vs": "https://cdnjs.cloudflare.com/ajax/libs/monaco-editor/0.34.1/min/vs" } });
    require(["vs/editor/editor.main"], function (){
        monaco.editor.setTheme("vs-dark");
        
        let content = fileContent;
        let language = fileExtension;
        
        if (container === "review-monaco-editor" && typeof reviewFileContent !== 'undefined') {
            content = reviewFileContent;
            language = reviewFileExtension;
        }
        
        let editor = monaco.editor.create(document.getElementById(container), {
            value: content,
            language: language,
            fontSize: 20,
            readOnly: readOnly
        });
        
        if (!readOnly) {
            window.monacoEditor = editor;
        }
        
        function adjustFontSize(){
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
            else {
                editor.updateOptions({ fontSize: 16 });
            }
        }
        
        const mediaQueries = [
            "(min-width: 1024px)",
            "(min-device-width: 768px) and (max-device-width: 1024px)",
            "(max-device-width: 480px) and (orientation: portrait)",
            "(max-device-width: 640px) and (orientation: landscape)"
        ];
        
        for (const mediaquery of mediaQueries) {
            const mediaQuery = window.matchMedia(mediaquery);
            mediaQuery.addEventListener("change", adjustFontSize);
        }
        
        adjustFontSize();
        
        function adjustEditorSize(){
            editor.layout();
        }
        
        window.addEventListener("resize", adjustEditorSize);
    });
}

