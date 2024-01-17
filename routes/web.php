<?php

use Google\Client;
use App\Services\HubSpotServices;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use App\Services\GoogleShoppingServices;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| HubSpotServices Route
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [ProductController::class, 'index'])->name('welcome');
Route::get('/feed', [ProductController::class, 'generateFeed'])->name('generateFeed');


Route::get('/alldata', function(){
    $accessToken = "pat-na1-cd788109-1900-4266-b652-b8c129ed334c";
    $contac = new HubSpotServices();
    dd($contac->setToken($accessToken)->setTable('contact')->read()->json());
});

Route::get('/create', function(){

    $accessToken = "pat-na1-cd788109-1900-4266-b652-b8c129ed334c";
    $data = [
        'associations' => [
            [
                'to' => [
                    'id' => '201'
                ],
                'types' => [
                     [
                        'associationCategory' => 'HUBSPOT_DEFINED',
                        'associationTypeId' => 3,
                    ],
                ]
            ]
        ],
        'properties' => [
                    "amount"=> "1500.00",
                    "dealname"=> "Buy a Planet Mars",
                    "pipeline"=> "default",
                    "closedate"=> "2024-12-12T16:50:06.678Z",
                    "dealstage"=> "presentationscheduled",
                    ],
        ];

    $properties = [
        'properties'=>[
            "email"=> "vincentiusfransis@gmail.com",
            "phone"=> "+6287735583565",
            "company"=> "Tjar Commerce",
            "website"=> "tjar.sa",
            "lastname"=> "Asisi",
            "firstname"=> "Fransiskus"
        ]
    ];

    $create = new HubSpotServices();
    $response = $create->setToken($accessToken)->create($properties);

    dd($response->json());
});

Route::get('/update', function(){
    $accessToken = "pat-na1-cd788109-1900-4266-b652-b8c129ed334c";
    $properties = [
        'lastname'=>'Bagong',
        'email'=>'ranger@gmail.com'
    ];

    $update = new HubSpotServices();
    $response = $update->update(251,$accessToken,$properties);

    dd($response);
});

Route::get('/delete', function(){
    $accessToken = "pat-na1-cd788109-1900-4266-b652-b8c129ed334c";
    $delete = new HubSpotServices();
    $response = $delete->setToken($accessToken)->setTable('deals')->delete(16854489693);

    dd($response);
});

/*
|--------------------------------------------------------------------------
| Google Shopping Route
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/allproducts', function(){
    $path = storage_path('content-api-key.json');
    $product = new GoogleShoppingServices();
    $response = $product->setCredential($path)->setMerchantId('5323492001')->getAllProducts()->json('resources');
});

Route::get('/products', function(){
    $path = storage_path('content-api-key.json');
    $product = new GoogleShoppingServices();
    $productId = "online:en:GB:12345";
    dd($product->setCredential($path)->setMerchantId('5323492001')->getProduct($productId)->json());
});
Route::get('/deleteproducts', function(){
    $path = storage_path('content-api-key.json');
    $product = new GoogleShoppingServices();
    $productId = "online:en:GB:12345";
    dd($product->setCredential($path)->setMerchantId('5323492001')->delete($productId)->json());
});

Route::get('/createproduct', function(){
    $path = storage_path('content-api-key.json');
    $product = new GoogleShoppingServices();
    $data = [
        "offerId"               => "Book1213",
        "title"                 => "Book OF Programmer",
        "description"           => "A classic novel about the French",
        "link"                  => "http://tjar.sa",
        "imageLink"             => "https://picsum.photos/200/300",
        "contentLanguage"       => "id",
        "targetCountry"         => "ID",
        "feedLabel"             => "ID",
        "channel"               => "online",
        "availability"          => "in stock",
        "condition"             => "new",
        "googleProductCategory" => "Media > Books",
        "price"                 => [
            "value"     => "135000",
            "currency"  => "IDR"
        ]
    ];
    $response = $product->setCredential($path)->setMerchantId('5323492001')->create($data);

    dd($response->json());
});

Route::get('/updateproduct', function(){
    $path = storage_path('content-api-key.json');
    $product = new GoogleShoppingServices();
    $data = [
        "title" => "Book In Another World"
    ];
    $productID = "online:en:GB:12345";
    dd($product->setCredential($path)->setMerchantId('5323492001')->update($productID,$data)->json());
});

Route::get('/gettoken', function(){
    $path = storage_path('content-api-key.json');
    $service = new GoogleShoppingServices();
    dd($service->setCredential($path));
});


Route::get('/createbatchproducts', function(){
    $token = "ya29.c.c0AY_VpZj3foJEe18O3z_BQrS-eBwZE3TqRqSfUZyDtjxWqAxxAKr1IdHVRSNmYgQD-1Jr-PO1q5UolmuXbLGVGclM2ZpIDfOiOkZrD9-XeZ5RAa3878YrncKfDBRh1Dm9XbaPk9Y-U91TUtkkQxzjrnmjh7udvTkhSNR767l32knt73ikyeJ3_1PqDmBCxJEs8SrOzbmVpth4Ct1lfE-UkSJYEDDnQBF7-tRb-0GHM81A3B7ldy5yXzbz6Y65MPR39aKvZBgR_soDekqpKKPSqJ1dCRXIpXwXornYGOkuy51faOkFtDG1aCEiOYxnJH7YiRv8B2Y-rgtHz7Lath10e0gl--Pq9tJQX5eGG9FPLTzAQwqKdXYfbLEH384ChYV1RQW52FjxQRJJYg-61O35djIpa5Jpvs3al091t1-yWdoOS9re_oB7e--z-gXRBlU3M9zIlv9cnqShc82dnmzf6vXdth7ZalnVQYQM2xUutpVIOlxtWZvn3IvV22F0_n59_4a7x_pZsYvvy1iehiex4vZ37Q9jz26Wix5-M8juXfVo-1IqXI9Bjr4wXp4uOiJzgoI8JljonajSFn3FaqV2Mjzv_WfXJbjQbZl3caMck_b43bXxs4Sjq10YOgiB51Q2OF_gg0a6YQrh5h15t1U-zF3YS_shfYl6WRdrwQrrJ1V3qen7jx5jp-w-ZfhJ1uhx66mSyZBuOJF8jhRoi05OwjU94cFy4OlVl1Ijnrvnw4pdtYviRYdSvbusl4vhOvjruR_Ft6ggZ-sZ1zbR9iWxlt_d-UqorBrU9BaJsnqhbdOVWwgdWaVhaW-qVrbuBmnM9S2au5amtblvbezhJ144U95encZRn_9Mnc9Roznsrpm4JRbIXuttckbayOyewq-h5ieefBRx541Rq0W2YWmXjfh1iMaB5RBWUuXWscfFkVr_l4mcnkwZY3WmppM2_mcigkusl1Iake8rwXcfsBfJRvz4M0p67zUaShS7d7Y14VZBFs5pO66VkJp";
    $path = storage_path('content-api-key.json');
    $pathProduct = storage_path('product.json');
    $jsonData = json_decode(file_get_contents($pathProduct), true);
    $base_url = "https://shoppingcontent.googleapis.com/content/v2.1/products/batch";

    $create = Http::acceptJson()->withToken($token)->post($base_url, $jsonData);
    dd($create->json());
});
