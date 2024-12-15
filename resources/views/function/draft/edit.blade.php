<x-default-layout
  title="Edit {{ $draft->phelNamespace }}/{{ $draft->name }} (draft) - PhelDocs"
>
  <main id="function_draft_edit">
    <h2>{{ $draft->phelNamespace }}/{{ $draft->name }}&nbsp;(draft)</h2>
    <p>Edit the information of a draft of Phel's function.</p>
    <form id="draft" method="post" action="{{ route('function.draft.update', ['id' => $draft->id]) }}">
      @error('phelNamespace')
      <p id="error_phelNamespace">{{ $message }}</p>
      @enderror
      <label for="phelNamespace">Namespace:</label>
      <input type="text" id="phelNamespace" name="phelNamespace" maxlength="255" placeholder="ex. phel\\core" pattern="[A-Za-z][-0-9A-Z\\a-z]*" aria-invalid="@error('phelNamespace') true @else false @enderror" aria-errormessage="error_phelNamespace" required />
      @error('name')
      <p id="error_name">{{ $message }}</p>
      @enderror
      <label for="name">Name:</label>
      @php
        $basePattern = '!%*+-/<=>?A-Z_a-z';
      @endphp
      <input type="text" id="name" name="name" maxlength="255" placeholder="ex. def" pattern="{{ "[$basePattern][0-9$basePattern]*" }}" aria-invalid="@error('name') true @else flase @enderror" aria-errormessage="error_name" required />
      @error('symbol_type')
      <p id="error_symbol_type">{{ $message }}</p>
      @enderror
      <label for="symbol_type">Symbol&nbsp;Type:</label>
      <select id="symbol_type" name="symbol_type" aria-invalid="@error('symbol_type') true @else false @enderror" aria-errormessage="error_symbol_type" required>
        <option value="special-form">Special Form</option>
        <option value="macro">Macro</option>
        <option value="function" selected>Function</option>
      </select>
      @error('description')
      <p id="error_description">{{ $message }}</p>
      @enderror
      <label for="description">Description:</label>
      <textarea id="description" name="description" maxlength="16000" aria-invalid="@error('description') true @else false @enderror" aria-errormessage="error_description"></textarea>
      <button type="submit">Submit</button>
      <button type="reset">Reset</button>
      @csrf
    </form>
  </main>
</x-default-layout>
