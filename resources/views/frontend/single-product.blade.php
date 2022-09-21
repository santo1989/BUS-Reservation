<x-frontend-layout>
    <div class="row">
        <div class="col-md-4 mb-5">
            <div class="card h-100">
                {{-- <img class="card-img-top" src="{{ asset('storage/products/'.$product->image) }}" height="180" alt="..." /> --}}
                <!-- Product details-->
            </div>
        </div>

        <div class="col-md-8 mb-5">
            <div class="card h-100">
                <!-- Sale badge-->
                <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Sale</div>

                <!-- Product details-->
                <div class="card-body p-4">
                    <div class="text-center">
                        <!-- Product name-->
                        <h5 class="fw-bolder">
                            {{-- {{ $product->title }} --}}
                        </h5>
                        {{-- <p> {{ $product->description }}</p> --}}
                        <!-- Product reviews-->
                        <div class="d-flex justify-content-center small text-warning mb-2">
                            <div class="bi-star-fill"></div>
                            <div class="bi-star-fill"></div>
                            <div class="bi-star-fill"></div>
                            <div class="bi-star-fill"></div>
                            <div class="bi-star-fill"></div>
                        </div>
                        <!-- Product price-->
                        {{-- <span class="text-muted text-decoration-line-through">TK {{ $product->price }}</span> --}}
                        {{-- TK {{ $product->price - $product->discount  }} --}}
                    </div>
                </div>
                <!-- Product actions-->
                <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                    {{-- <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="{{ route('add_to_cart', ['product'=>$product->id]) }}">Add to cart</a></div> --}}

                    {{-- <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="{{ url('transaction/create') }}">Buy</a></div> --}}
                </div>
            </div>
        </div>
    </div>

    {{-- <hr>
    Comments:

    <ul>
        @foreach ($product->comments as $comment)
        <li> {{ $comment->body }}
            By - {{ $comment->createdBy->name ?? 'Anonymous' }}
            At {{ $comment->created_at->diffForHumans() }}
        </li>
        @endforeach
    </ul> --}}

    {{-- @auth
    <form action="{{ route('comments.store', ['id' => $product->id]) }}" method="post">
        @csrf
        <textarea name="body" class="form-control"></textarea>
        <button type="submit">
            Save
        </button>
    </form>
    @endauth --}}

    @push('css')
        <style>
            body{
                background: skyblue;
            }
        </style>
    @endpush

</x-frontend-layout>