# Movie Library API

It is a RESTful API for managing movie library using Laravel
The API supports basic CRUD (create, read, update, delete) operations for movies. With RESTful APIs
With the use of advanced techniques such as pagination, filtering and sorting.

## Attributes

-   add users information(name, email,password)
-   View, edit and delete user.
-   Add movie information (title, auther name, release date, genre, and description)
-   View, edit and delete Movie.
-   Display the Movies informationtitle, auther name, release date, genre, description and his rating
-   The ability to display Movies in descending or ascending order, classifying them according to genre and author, and specifying the number of Movies to be shown per page.
-   Add Rating (user_id,movie_id ,rating,review) For every movie.
    -View edit and delete Rating.

## Usage

create a Web API and implement the following _endpoints_ for :

## API Endpoints

# Admin API

| Method | URL                                                                                    | Description                                                                |
| ------ | -------------------------------------------------------------------------------------- | -------------------------------------------------------------------------- |
| POST   | /api/Movies                                                                            | Add movie using the information sent inside the `request body`.            |
| GET    | /api/Movies?per_page=10&genre=Action&director=James&sort_by=release_year&sort_dir=desc | Returns a collection of movies according to the properties you specify.    |
| PUT    | /api/Movies/:id                                                                        | Update movie using the information sent inside the `request body` by `id`. |
| GET    | /api/Movies/:id                                                                        | Returns the information of the movie and its rating information by `id`.   |
| DELETE | /api/Movies/:id                                                                        | Removes the movie and its rating information by `id`.                      |
| GET    | /api/Rating/:id                                                                        | Returns the information of the rating by `id`.                             |
| DELETE | /api/Rating/:id                                                                        | Removes the rating with the specified `id`.                                |
| POST   | /api/User                                                                              | Add user using the information sent inside the `request body`.             |
| GET    | /api/User/:id                                                                          | Returns the information of the user by `id`.                               |
| PUT    | /api/User/:id                                                                          | Update user using the information sent inside the `request body` by `id`.  |
| DELETE | /api/User/:id                                                                          | Removes the user with the specified `id`.                                  |

# User API

| Method | URL             | Description                                                                 |
| ------ | --------------- | --------------------------------------------------------------------------- |
| POST   | /api/Rating     | Add rating using the information sent inside the `request body`.            |
| GET    | /api/Rating/:id | Returns the information of the rating by `id`.                              |
| PUT    | /api/Rating/:id | Update rating using the information sent inside the `request body` by `id`. |
| DELETE | /api/Rating/:id | Removes the rating with the specified `id`.                                 |
|  |

#### Movie Schema

Each Movie _resource_ should conform to the following structure :

```php
{
   'title' => ['required'],
   'director' => ['required', 'string'],
   'genre' => ['required', 'string'],
   'release_year' => ['required', 'integer'],
    'description' => ['required', 'string'],
}
```

#### Rating Schema

```php
{
    'user_id' => ['required', 'exists:users,id'],
    'movie_id' => ['required', 'exists:movies,id'],
    'rating' => ['required', 'integer', 'between:1,5'],
    'review' => ['nullable', 'string'],,
}

```

#### User Schema

```php
{
     'name' => 'sometimes|required|string|max:255',
     'email' => 'sometimes|required|string|email|max:255|unique:users,email,' . $id,
     'password' => 'sometimes|required|string|min:8',


```

#### Important Notes

-   Test your work manually using Postman or HTTP. .
-   You are welcome to create additional files.
-   In your solution, it is essential that you follow best practices and produce clean and professional results.

## Contact

For any inquiries or support, please contact:

-   phone number:+963991851269
-   GitHub: [Mohammed Almostfa ](https://github.com/MohammedAlmostfa)
-   LinkedIn:[ Mohammed Almostfa](https://www.linkedin.com/in/mohammed-almostfa-63b3a7240/)

---

Thank you for using Credential Saver!
