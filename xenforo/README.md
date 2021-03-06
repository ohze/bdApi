# XenForo API XenForo Provider Add-on

## Changelog

### 1.5.1

* Added param `reason` for post/thread/profile post deletion
* Added `latest_posts` into thread data
* Added `latest_comments` into profile post data
* Added `timeline_username` into profile post data
* Added `user_followers_total` and `user_followings_total` into user data
* Added `username` into `associatable` user data
* Added `user_unread_notification_count` for alert ping
* Added support for thread prefixes
* Added support for social accounts association (Facebook, Google)
* Improved support for Google ID token
* Improved attachment data output
* Improved logging
* Fixed bugs

### 1.4.7

* Added POST `/search/indexing`
* Added `user_last_seen_date` for GET `/users`
* Added `user_fields` for GET `/users` (deprecated `user_custom_fields`)
* Added `permissions.edit_title` for GET `/threads`
* Added `last_post` for GET `/threads`
* Added `order`=`natural_reverse` for GET `/conversation-messages`
* Added support for XenForo 1.5.0 features: content tagging, 2fa
* Added support for pages
* Added support for thread poll
* Added support for user ignores
* Added support for view logging (thread, attachment)
* Added support for spam checking
* Added `locale` parameter
* Added option `trackSession`
* Added option `userNotificationConversation`
* Improved support for conversation message (report)
* Added daily version check from xfrocks.com
* Fixed bugs

### 1.4.3

* Added demo client for first time installation
* Added supported for latest OAuth 2.0 rfc with new grant types: implicit, client credentials and jwt bearer
* Added support for social login
* Added support for user groups
* Added support for alerts
* Added support for profile posts
* Added support for forum watch
* Added support for pubsubhubbub with user data, alerts and posts
* Added security feature: restrict access (AdminCP option)
* Added security feature: white listed domains for client
* Added GET /navigation
* Added GET /users/find
* Added PUT /users/:userId
* Added POST /oauth/token/admin
* Improved performance
* Fixed bugs

### 1.2

* Added support for one time token
* Added support for all requests in sdk.js
* Added support for user custom fields
* Added support for multiple forum ids in GET /threads
* Added GET /notifications
* Added `natural_reverse` order for GET /posts
* Added `post_is_first_post` for (post)
* Added `user_unread_conversation_count` for (user)
* Improved session handling
* Improved HTTPS support
* Improved logging
* Fixed bugs

### 1.1

* Added support for attachment data
* Added support for conversation and message
* Added support for sticky thread
* Added support for HTTP header X-HTTP-Method-Override to override request method
* Added DELETE /posts/:postId/attachments/
* Added password encryption
* Fixed bugs

### 1.0

* Added GET /posts/:postId/likes to get like, POST to like, DELETE to unlike
* Added POST /users to create new user
* Added POST /users/:userId/avatar to upload avatar, DELETE /users/:userId/avatar to delete avatar
* Added POST /batch support to execute multiple requests at once
* Added followers to threads and users with POST, DELETE to follow or unfollow
* Added `attachments` to post data, POST /threads/attachment and POST /posts/attachment to upload attachment to thread or post
* Added common parameters `fields_include`, `fields_exclude` to filter data
* Added common parameter `order` to.. order
* Added logging

### 0.9.4

* First public release
