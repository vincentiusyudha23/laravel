{!! '<'.'?xml version="1.0"?>' !!}

<rss version="2.0" xmlns:g="http://base.google.com/ns/1.0">

    <channel>
        <title>Testing Commerce Product Feed</title> 
        <link>{{ route('welcome') }}</link> 
        <description>A description of your content</description> 
        
        @foreach ($products as $product)
            <item> 
                <g:id>{{ $product->id }}</g:id>
                <title>{{ $product->name}}</title>
                <link>{{ route('welcome') }}</link>
                <description>{{ $product->description }}</description>
                <g:image_link>https://picsum.photos/id/{{ $product->id }}/200/300</g:image_link> 
                <g:price>{{ $product->price }} IDR</g:price> 
                <g:availability>in_stock</g:availability> 
                <g:gtin>3234567890126{{ $product->id }}</g:gtin>
                <g:brand>{{ $product->name }}</g:brand>   
                <g:update_type>merge</g:update_type> 
            </item>
        @endforeach
        
    </channel> 
</rss>