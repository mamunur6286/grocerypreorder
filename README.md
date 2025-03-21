# Laravel Grocery Store Pre-Order
The Grocery Preorder is a Laravel Package for getting pre order in a grocery shop.

The Laravel Grocery Store Pre-Order Package allows customers to place pre-orders for grocery items seamlessly. It provides an intuitive form with conditional fields, reCAPTCHA for security, and rate limiting to prevent spam. The package includes backend management features such as search, pagination, ordering, and soft deletes. It also supports email notifications for both customers and admins, leveraging Laravel’s event system. Built with PostgreSQL, it ensures robust data handling and smooth integration into any Laravel project.

### Usage or Installation 
```
composer require mamunur6286/grocerypreorder
```

# How to Use Grocery Preorder
As a developer we need different types of currency exchange for our various projects. For this situation I developed a laravel package to prevent this problem to handle currency change. It can improve your development life if you use it properly. The used precondition and instruction is given below!

In this tutorial, I'll take you through an example on how to use the Grocery Preorder Laravel package in just 5 steps. So, let's go ahead and dive into it.

#### 1. Create our folder for our new package.

Create a fresh Laravel project;

```
composer create-project laravel/laravel example-app
```

After a new Laravel install we got to the inside of the project directory by ` cd example-app `.

#### 2. Install Grocery Preorder Package using Composer.

Inside your command prompt navigate to the folder with your project name. In our case: `example-app`, and run the following command:

```
composer require mamunur6286/grocerypreorder
```

This will initialize the `Grocery Preorder` package in your project and update the composer dependencies in `composer.json` file.

Next, we need to add our new Service Provider in our config/app.php inside of the `providers[]` array:

```
'providers' => [

    /*
     * Laravel Framework Service Providers...
     */
    Illuminate\Auth\AuthServiceProvider::class,
    //.. Other providers
    
    Mamunur6286\GroceryStore\PreOrderManagement\PreOrderServiceProvider::class,

],
```
#### 5. Publishing Migrations and Configurations
After installing the Laravel Grocery Store Pre-Order Package, you need to publish its migration and configuration files to customize them as needed.
```
// for publish config
php artisan vendor:publish --tag=preorder-config

for publish mygration
php artisan vendor:publish --tag=preorder-migrations

```

#### 6. Basic Usease
this package give you some route to use your frontend app the routes is 
```
api/v1/grocery-store/pre-orders
api/v1/grocery-store/pre-orders/store
api/v1/grocery-store/pre-orders/remove/{id}

```
The basic methods how extends your  `store()` `index()` and flow bellow code:

```
    public function index(Request $request)
    {
        try {

            $phone = $request->get('phone');
            $email = $request->get('email');
            $name = $request->get('name');
            $productId = $request->get('preduct_id');
            
            $preOrders = PreOrder::query()
                ->when($name, function (Builder $query) use ($name) {
                    return $query->where('name', 'LIKE', '%'.$name.'%');
                })
                ->when($productId, function (Builder $query) use ($productId) {
                    return $query->where('product_id', $productId);
                })
                ->when($email, function (Builder $query) use ($email) {
                    return $query->where('email', 'LIKE', '%'.$email.'%');
                })
                ->when($phone, function (Builder $query) use ($phone) {
                    return $query->where('phone', 'LIKE', '%'.$phone.'%');
                })
                ->latest()
                ->paginate(config('app.per_page'));


            return response()->json([
                'success' => true,
                'message' => 'Pre Order created successfully.',
                'data' => $preOrders
            ], Response::HTTP_OK);

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => app()->isProduction() ? 'Internal Server Error' : $e->getMessage(),
                'data' => []
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function store(PreOrderRequest $request, )
    {
        try {

            $preOrder = PreOrder::create($request->all());

            event(new PreOrderEmailEvent($preOrder));

            return response()->json([
                'success' => true,
                'message' => 'Pre Order created successfully.',
                'data' => []
            ], Response::HTTP_OK);

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => app()->isProduction() ? 'Internal Server Error' : $e->getMessage(),
                'data' => []
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    
```

#### 7. Here we use event litener to send email with queue 
Let's see how to work this package in event litener and laravle queue :

```
Bus::chain([
    new SendAdminEmailNotificationJob($preOrder), 
    new SendUserEmailNotificationJob($preOrder)
])->dispatch();
```


#### Conclusion. 
That's how to use the Laravel gorcerypreorder package. Thank you for using Grocery Preorder. 
