# Database

## Tables

### Users

Table `users`

### Authors & Posts

Table `authors`

```SQL
/*  name          datatype          constraints */
    id            bigint            PRIMARY KEY
    userid        varchar(32)       NOT NULL UNIQUE -- alias of user
    name          varchar(128)      NOT NULL
    url           varchar(255)  -- external personal page
    profile_image varchar(255)
    blocked       bit           -- posts published by the author will be blocked
```

Table `posts`

```SQL
/*  name          datatype          constraints */
    id            bigint            PRIMARY KEY
    author_id     bigint            NOT NULL
    replied_to    bigint        -- which post is replied to
    text          varchar(1000)
    referred_to   varchar(255)  -- external page that the post refer to
    created_at    datetime      -- time of the post was published
    updated_at    datetime      -- time of the post was edited by author
    deleted_at    datetime      -- time of the post was removed from db
/* constraints */
    FOREIGN KEY (author_id)  REFERENCES authors(id)
    FOREIGN KEY (replied_to) REFERENCES posts(id)
```

### Keywords & Tags

Table `keywords`

```SQL
/*  name          datatype          constraints */
    id            bigint            PRIMARY KEY
    word          varchar(128)      NOT NULL UNIQUE
    description   varchar(1000)
```

Table `tags`

```SQL
/*  name          datatype          constraints */
    id            bigint            PRIMARY KEY
    name          varchar(128)      NOT NULL UNIQUE
    type_id       bigint
    blocked       bit           -- posts with this tag will be blocked
    description   varchar(1000)
/* constraints */
    FOREIGN KEY (type_id) REFERENCES tag_types(id)
```

Table `tag_types`

```SQL
/*  name          datatype          constraints */
    id            bigint            PRIMARY KEY
    name          varchar(128)      NOT NULL UNIQUE
```

### Intermediary Tables

Table `keywords_tags`

```SQL
/*  name          datatype          constraints */
    id            bigint            PRIMARY KEY
    keyword_id    bigint            NOT NULL
    tag_id        bigint            NOT NULL
/* constraints */
    FOREIGN KEY (keyword_id) REFERENCES keywords(id)
    FOREIGN KEY (tag_id)     REFERENCES tags(id)
    UNIQUE (keyword_id, tag_id)
```

Table `posts_tags`

```SQL
/*  name          datatype          constraints */
    id            bigint            PRIMARY KEY
    post_id       bigint            NOT NULL
    tag_id        bigint            NOT NULL
/* constraints */
    FOREIGN KEY (post_id) REFERENCES posts(id)
    FOREIGN KEY (tag_id)  REFERENCES tags(id)
    UNIQUE (post_id, tag_id)
```
