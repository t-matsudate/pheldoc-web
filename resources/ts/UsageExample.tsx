import React, { useState } from 'react';
import { createRoot } from 'react-dom/client';
import styled from 'styled-components';
import hljs from 'highlight.js';
// NOTE: Currently we use Clojure's highlight instead because no highlight for the Phel exists.
import clojure from 'highlight.js/lib/languages/clojure';

hljs.registerLanguage('phel', clojure);

interface ErrorsProps {
  field: string;
  messages: string[];
}

function Errors(props: ErrorsProps): React.ReactNode {
  const errorItems = props.messages.map((message, index) => <li key={'error_' + props.field + '_' + index}>{message}</li>);
  return <ul id={'error_' + props.field}>{errorItems}</ul>;
}

const StyledErrors = styled(Errors)`
  margin: 0rem 1rem;

  li {
    margin: 1rem 0rem;
    color: hsl(0, 73%, 41%);
  }
`;

interface UsageExampleFormProps {
  postTo: string;
  csrfToken: string;
}

function UsageExampleForm(props: UsageExampleFormProps): React.ReactNode {
  const [example, updateExample] = useState('');
  const [errors, setErrors] = useState<Record<string, string[]>>({});

  function submit(e: SubmitEvent): Promise<Response> {
    const value = (e.submitter as HTMLButtonElement).value;
    let result = Promise.resolve(new Response(null, {status: 304}));

    if (value === 'submit') {
      const formData = new FormData();
      formData.append('example', example);
      result = fetch(props.postTo, {
        method: 'post',
        headers: {
          'x-csrf-token': props.csrfToken
        },
        body: formData
      });
    }

    return result;
  }

  return (
    <dialog id="modal">
      <form
        id="usage_example_form"
        method="dialog"
        onSubmit={async e => {
          const response = await submit(e.nativeEvent as SubmitEvent);

          if (response.ok) {
            location.reload();
          } else {
            const message = await response.json();
            setErrors(message.errors);
            e.preventDefault();
          }
        }}
      >
        <label htmlFor="example">
          <textarea
            id="example"
            autoFocus={true}
            onChange={e => updateExample(e.target.value)}
            aria-invalid={Object.hasOwn(errors, 'example')}
            aria-errormessage='error_example'
          ></textarea>
        </label>
        <pre><code className="hljs language-phel">{ hljs.highlight(example, {language: 'phel'}).value }</code></pre>
        <button type="submit" value="submit">Submit</button>
        <button type="reset" value="reset">Reset</button>
      </form>
      {Object.hasOwn(errors, 'example') && <StyledErrors field='example' messages={errors.example} />}
    </dialog>
  );
}

const StyledUsageExampleForm = styled(UsageExampleForm)`
  --actual-height: ${window.innerHeight / window.devicePixelRatio};

  width: 80%;
  height: calc(var(--actual-height) * 0.8);
  border: 8px solid hsl(257, 57%, 41%);
  border-radius: 8px;
  padding: 1rem;

  #usage_example_form {
    display: grid;
    grid-template-columns: 50% 1fr;
    gap: 1rem;

    #example {
      padding: 1rem;
      /* Somehow form parts are pre-padded by 2px. */
      width: calc(100% - 1rem - 2px);
      height: calc(var(--actual-height) * 0.64 - 1rem - 2px);
    }

    button {
      width: 100%;
      height: 2rem;
      background-color: hsl(257, 57%, 41%);
      color: hsl(0, 0%, 98%);
      border-radius: 8px;
    }
  }
`;

const element = document.getElementById('root') as HTMLElement;
const postTo = element.dataset.postTo as string;
const csrfToken = element.dataset.csrfToken as string;
const root = createRoot(element);
root.render(<StyledUsageExampleForm postTo={postTo} csrfToken={csrfToken} />);
