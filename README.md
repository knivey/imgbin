#ImgBin
Laravel site to upload and share images. Still a WIP



## TODO

### Phase 1
Goal here is just get it ready to put on a server and use.
- When uploader views image page have ability to edit title and description.
- Merge gallery and welcome pages to get rid of welcome page
  - When done just remove IndexController and route the view
- Clean up all the image path stuff
- Admin users that can delete images or users
- Hosting: figure out enable email stuff 
- Captcha for registration page

### Phase 2 
Add Features

- Gallery options on how to sort images
- Gif support in thumbs
- Image view buttons for sharing (copy to clip)
- Viewer stats on images
- Button for liking images
- Search feature
  - Image tags for searching or viewing that category in gallery
- Comments section on images
  - replys to comments
  - comments/replies can be reaction images
- Upload page many files at a time
- Upload page use livewire or something to have progress of upload 
- Upload based on copy paste
- Upload from web URL
- Dark theme
- Gallery view infinite scroll instead of pagination
- Videos support
- Webhook events for uploads
- API for uploads so that i can then do:
  - Browser extensions to upload
  - cmd line uploader
  - phone app
