import tinymceUrl from 'tinymce/tinymce.min.js?url';
import modelUrl from 'tinymce/models/dom/model.min.js?url';
import iconsUrl from 'tinymce/icons/default/icons.min.js?url';
import themeUrl from 'tinymce/themes/silver/theme.min.js?url';
import advlistUrl from 'tinymce/plugins/advlist/plugin.min.js?url';
import autolinkUrl from 'tinymce/plugins/autolink/plugin.min.js?url';
import linkUrl from 'tinymce/plugins/link/plugin.min.js?url';
import listsUrl from 'tinymce/plugins/lists/plugin.min.js?url';
import tableUrl from 'tinymce/plugins/table/plugin.min.js?url';
import codeUrl from 'tinymce/plugins/code/plugin.min.js?url';
import 'tinymce/skins/ui/oxide/skin.css';
import 'tinymce/skins/content/default/content.css';
import 'tinymce/skins/ui/oxide/content.css';

const beritaEditor = document.querySelector('#isi-berita');
const resolveAssetUrl = (url) => new URL(url.split('/').pop(), import.meta.url).href;

const loadScript = (src) => new Promise((resolve, reject) => {
    const script = document.createElement('script');
    script.src = resolveAssetUrl(src);
    script.onload = resolve;
    script.onerror = reject;
    document.head.appendChild(script);
});

if (beritaEditor) {
    (async () => {
        await loadScript(tinymceUrl);
        await loadScript(modelUrl);
        await loadScript(iconsUrl);
        await loadScript(themeUrl);
        await loadScript(advlistUrl);
        await loadScript(autolinkUrl);
        await loadScript(linkUrl);
        await loadScript(listsUrl);
        await loadScript(tableUrl);
        await loadScript(codeUrl);

        window.tinymce.init({
            selector: '#isi-berita',
            height: 420,
            skin: false,
            content_css: false,
            menubar: false,
            branding: false,
            promotion: false,
            license_key: 'gpl',
            plugins: 'advlist autolink link lists table code',
            toolbar: 'undo redo | blocks | bold italic underline | alignleft aligncenter alignright | bullist numlist | link table | removeformat code',
            content_style: 'body { font-family: Inter, ui-sans-serif, system-ui, sans-serif; font-size: 16px; line-height: 1.75; }',
        });
    })();
}
