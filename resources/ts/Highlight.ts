import hljs from 'highlight.js';
import clojure from 'highlight.js/lib/languages/clojure';

// NOTE: Currently we use Clojure's highlight instead because no highlight for the Phel exists.
hljs.registerLanguage('phel', clojure);
hljs.highlightAll();
