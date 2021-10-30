# API

## Object format

### Post

```JSON
{
  "id"          : int,
  "author_id"   : Author.id,
  "replied_to"  : Post.id OR null,  // which post is replied to
  "text"        : str,
  "referred_to" : str,      // external page that the post refer to
  "created_at"  : HTTP-date,
  "updated_at"  : HTTP-date OR null,
  "tags"        : [Tag.id]
}
```

\* [HTTP-date](https://httpwg.org/specs/rfc7232.html#imported.abnf): a datetime format used in HTTP headers.

### Author

```JSON
{
  "id"          : int,
  "userid"      : str,      // alias of user
  "name"        : str,
  "url"         : str,      // external personal page
  "profile_img" : str,      // url of image
  "blocked"     : bool      // posts published by the author will be blocked
}
```

### Keyword

```JSON
{
  "id"          : int,
  "word"        : str,
  "description" : str,
  "tags"        : [Tag]     // associated tags
}
```

### Tag

```JSON
{
  "id"          : int,
  "name"        : str,
  "type"        : str,
  "description" : str,
  "blocked"     : bool      // posts with this tag will be blocked
}
```

## Endpoint map

<table>
  <tr>
    <th></th>
    <th>Endpoint</th>
    <th>Description</th>
    <th>Authorization</th>
  </tr>
  <tr>
    <td rowspan="5">Posts</td>
    <td><code>GET /posts</code></td>
    <td>Retrieve posts</td>
    <td></td>
  </tr>
  <tr>
    <td><code>GET /posts/:id</code></td>
    <td>Retrieve a post with an ID</td>
    <td></td>
  </tr>
  <tr>
    <td><code>DELETE /posts/:id</code></td>
    <td>Delete a specific post by an ID</td>
    <td>Required</td>
  </tr>
  <tr>
    <td><code>PUT /posts/:post_id/tags/:tag_id</code></td>
    <td>Tag the post</td>
    <td>Required</td>
  </tr>
  <tr>
    <td><code>DELETE /posts/:post_id/tags/:tag_id</code></td>
    <td>Untag the post</td>
    <td>Required</td>
  </tr>
  <tr>
    <td rowspan="3">Authors</td>
    <td><code>GET /authors</code></td>
    <td>Retrieve authors</td>
    <td></td>
  </tr>
  <tr>
    <td><code>GET /authors/:id</code></td>
    <td>Retrieve an author with an ID</td>
    <td></td>
  </tr>
  <tr>
    <td><code>PATCH /authors/:id</code></td>
    <td>Modify attributes of specific author</td>
    <td>Required</td>
  </tr>
  <tr>
    <td rowspan="6">Keywords</td>
    <td><code>GET /keywords</code></td>
    <td>Retrieve keywords</td>
    <td></td>
  </tr>
  <tr>
    <td><code>GET /keywords/:id</code></td>
    <td>Retrieve a keyword with an ID</td>
    <td></td>
  </tr>
  <tr>
    <td><code>POST /keywords</code></td>
    <td>Create a new keyword</td>
    <td>Required</td>
  </tr>
  <tr>
    <td><code>PUT /keywords/:id</code></td>
    <td>Replace the keyword specified by ID with another keyword</td>
    <td>Required</td>
  </tr>
  <tr>
    <td><code>PATCH /keywords/:id</code></td>
    <td>Modify attributes of specific keyword</td>
    <td>Required</td>
  </tr>
  <tr>
    <td><code>DELETE /keywords/:id</code></td>
    <td>Delete a specific keyword by an ID</td>
    <td>Required</td>
  </tr>
  <tr>
    <td rowspan="7">Tags</td>
    <td><code>GET /tags</code></td>
    <td>Retrieve tags</td>
    <td></td>
  </tr>
  <tr>
    <td><code>GET /tags/:id</code></td>
    <td>Retrieve a tag with an ID</td>
    <td></td>
  </tr>
  <tr>
    <td><code>POST /tags</code></td>
    <td>Create a new tag</td>
    <td>Required</td>
  </tr>
  <tr>
    <td><code>PUT /tags/:id</code></td>
    <td>Replace the tag specified by ID with another tag</td>
    <td>Required</td>
  </tr>
  <tr>
    <td><code>PATCH /tags/:id</code></td>
    <td>Modify attributes of specific tag</td>
    <td>Required</td>
  </tr>
  <tr>
    <td><code>DELETE /tags/:id</code></td>
    <td>Delete a specific tag by an ID</td>
    <td>Required</td>
  </tr>
</table>

## API reference

### `GET /posts`

### `GET /posts/:id`

### `DELETE /posts/:id`

### `GET /authors`

### `GET /authors/:id`

### `PATCH /authors/:id`

### `GET /tags`

### `GET /tags/:id`

### `GET /tags/name/:name`

### `POST /tags`

### `PUT /tags/:id`

### `PATCH /tags/:id`

### `DELETE /tags/:id`

### `GET /keywords`

### `GET /keywords/:id`

### `POST /keywords`

### `PUT /keywords/:id`

### `PATCH /keywords/:id`

### `DELETE /keywords/:id`
