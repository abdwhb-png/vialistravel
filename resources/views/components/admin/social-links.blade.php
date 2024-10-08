<!-- Modal -->
<div class="modal fade" id="socialLinksModal" tabindex="-1" role="dialog" aria-labelledby="socialLinksModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="socialLinksModalLabel">Social Links</h5>
                <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h6>Note that if a social link is empty, then it wont be displayed on the frontend.</h6>
                <form method="POST" action="{{ route($route_prefix . 'updt-socialLinks') }}">
                    @csrf
                    @foreach ($links as $item)
                        <div class="form-group">
                            <label for="">
                                {{ $item->name }}
                            </label>
                            <input type="text" name="links[{{ $item->id }}]" class="form-control" id=""
                                placeholder="Is empty" value="{{ $item->url }}">
                        </div>
                    @endforeach

                    <div class="form-group">
                        <button type="submit" class="btn bg-gradient-dark w-100">SAVE CHANGES</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
