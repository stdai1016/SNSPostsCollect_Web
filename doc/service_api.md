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
    <td><a href="#get-apiposts"><code>GET /api/posts</code></a></td>
    <td>Retrieve posts</td>
    <td></td>
  </tr>
  <tr>
    <td><a href="#get-apipostsid"><code>GET /api/posts/:id</code></a></td>
    <td>Retrieve a post with an ID</td>
    <td></td>
  </tr>
  <tr>
    <td><a href="#delete-apipostsid"><code>DELETE /api/posts/:id</code></a></td>
    <td>Delete a specific post by an ID</td>
    <td>Required</td>
  </tr>
  <tr>
    <td>
      <a href="#put-apipostspost_idtagstag_id">
        <code>PUT /api/posts/:post_id/tags/:tag_id</code>
      </a>
    </td>
    <td>Tag the post</td>
    <td>Required</td>
  </tr>
  <tr>
    <td>
      <a href="#delete-apipostspost_idtagstag_id">
        <code>DELETE /api/posts/:post_id/tags/:tag_id</code>
      </a>
    </td>
    <td>Untag the post</td>
    <td>Required</td>
  </tr>
  <tr>
    <td rowspan="3">Authors</td>
    <td><a href="#get-apiauthors"><code>GET /api/authors</code></a></td>
    <td>Retrieve authors</td>
    <td></td>
  </tr>
  <tr>
    <td><a href="#get-apiauthorsid"><code>GET /api/authors/:id</code></a></td>
    <td>Retrieve an author with an ID</td>
    <td></td>
  </tr>
  <tr>
    <td><a href="#patch-apiauthorsid"><code>PATCH /api/authors/:id</code></a></td>
    <td>Modify attributes of specific author</td>
    <td>Required</td>
  </tr>
  <tr>
    <td rowspan="6">Keywords</td>
    <td><a href="#get-apikeywords"><code>GET /api/keywords</code></a></td>
    <td>Retrieve keywords</td>
    <td></td>
  </tr>
  <tr>
    <td><a href="#get-apikeywordsid"><code>GET /api/keywords/:id</code></a></td>
    <td>Retrieve a keyword with an ID</td>
    <td></td>
  </tr>
  <tr>
    <td><a href="#post-apikeywords"><code>POST /api/keywords</code></a></td>
    <td>Create a new keyword</td>
    <td>Required</td>
  </tr>
  <tr>
    <td><a href="#put-apikeywordsid"><code>PUT /api/keywords/:id</code></a></td>
    <td>Replace the keyword specified by ID with another keyword</td>
    <td>Required</td>
  </tr>
  <tr>
    <td><a href="#patch-apikeywordsid"><code>PATCH /api/keywords/:id</code></a></td>
    <td>Modify attributes of specific keyword</td>
    <td>Required</td>
  </tr>
  <tr>
    <td><a href="#delete-apikeywordsid"><code>DELETE /api/keywords/:id</code></a></td>
    <td>Delete a specific keyword by an ID</td>
    <td>Required</td>
  </tr>
  <tr>
    <td rowspan="7">Tags</td>
    <td><a href="#get-apitags"><code>GET /api/tags</code></a></td>
    <td>Retrieve tags</td>
    <td></td>
  </tr>
  <tr>
    <td><a href="#get-apitagsid"><code>GET /api/tags/:id</code></a></td>
    <td>Retrieve a tag with an ID</td>
    <td></td>
  </tr>
  <tr>
    <td><a href="#post-apitags"><code>POST /api/tags</code></a></td>
    <td>Create a new tag</td>
    <td>Required</td>
  </tr>
  <tr>
    <td><a href="#put-apitagsid"><code>PUT /api/tags/:id</code></a></td>
    <td>Replace the tag specified by ID with another tag</td>
    <td>Required</td>
  </tr>
  <tr>
    <td><a href="#patch-apitagsid"><code>PATCH /api/tags/:id</code></a></td>
    <td>Modify attributes of specific tag</td>
    <td>Required</td>
  </tr>
  <tr>
    <td><a href="#delete-apitagsid"><code>DELETE /api/tags/:id</code></a></td>
    <td>Delete a specific tag by an ID</td>
    <td>Required</td>
  </tr>
</table>

## API reference

### `GET /api/posts`

### `GET /api/posts/:id`

### `DELETE /api/posts/:id`

### `GET /api/authors`

### `GET /api/authors/:id`

### `PATCH /api/authors/:id`

### `GET /api/tags`

### `GET /api/tags/:id`

### `GET /api/tags/name/:name`

### `POST /api/tags`

### `PUT /api/tags/:id`

### `PATCH /api/tags/:id`

### `DELETE /api/tags/:id`

### `GET /api/keywords`

### `GET /api/keywords/:id`

### `POST /api/keywords`

### `PUT /api/keywords/:id`

### `PATCH /api/keywords/:id`

### `DELETE /api/keywords/:id`
