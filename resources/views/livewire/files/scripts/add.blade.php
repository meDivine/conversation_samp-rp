<div class="card-body">
    <form wire:submit.prevent="insert">
        <div wire:ignore>
            <textarea id="description" wire:model="description"></textarea>
        </div>
        <button type="submit">Submit</button>
    </form>

    @push('scr')
        <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
        <script>
            $('#description').summernote();
        </script>
    @endpush

</div>
