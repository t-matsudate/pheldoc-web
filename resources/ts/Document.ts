import { remark } from 'remark';
import remarkRehype from 'remark-rehype';

const description = document.getElementById('description') as HTMLParagraphElement;
const parsed = remark
  .use(remarkRehype)
  .processSync(description.innerText);
description.innerText = String(parsed);
