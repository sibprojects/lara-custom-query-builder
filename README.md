# lara_custom_query_builder

In Laravel, it's common for models to contain too much business logic. Fortunately, you can create custom Query Builders to make models slimmer and cleaner. In this article, we'll explore how to create and use custom Query Builders using the example of a Product model.

## Creating a Custom Query Builder
We'll start by creating a ProductBuilder class. This class will extend Illuminate\Database\Eloquent\Builder, allowing it to inherit all the standard Laravel query builder functionalities.

## Integrating Custom Query Builder into the Model
Next, we need to inform Laravel to use our custom builder when querying the Product model. To achieve this, we'll override the newEloquentBuilder method in the model.

Now, each time you build a query with Product::something(), you'll receive an instance of ProductBuilder.

## Using Custom Query Builder in a Controller
Let's look at an example of a controller that uses the custom Query Builder to filter and sort products.

## Extending Functionality
With custom Query Builders, you can easily add new methods for data manipulation. For example, a method to publish all products.

## Conclusion
Custom Query Builders provide flexibility and allow you to create and combine complex queries, encapsulating query logic in separate classes. This results in cleaner, more structured, and easily extendable code, improving maintainability and readability of your application.

Using custom Query Builders also helps organize business logic better and makes your models more "slim." This approach can significantly improve code quality and make it easier to maintain.
