##audio.php

  saveAudioFilepath() = upload file to directory->save filename and filepath to database -> returns the database id
  saveCoverFilepath() = same as saveAudioFIlepath
  addStream() = add data(user_id, music_id, date/time) to tbl_stream
  getMusicData() = selects all or single music data
  getRecommendedMusicData = selects music from music table based on the genres the user has lisened to
  getTopStreamMusicData = selects all music based on their streams in descending order
  getTopRatingMusicData = selects all music based on their average rating in descending order
  getMusicGenres = selects all of a musics genres


##genre.php

  storeGenres() = stores a music's genres on the pivot table(tbl_music_genre)
  deleteGenres() = delete rows form the pivot table(tbl_music_genre) based on music_id (used for updating music genres)

##userRequest.php

  registerUser = check if value of password and confirmPassword is the same->if the same, hash the password->insert details to database->if not the same, reload the page
  loginUser = check if there are matching data in the database-> if yes, go the homepage -> if not, set message then return to login page
  loginAdmin = same as loginUser but it checks whether the user is an admin or not -> if yes, go to admin homepage -> if not, go to user homepage
  logoutUser = logout the user

##audioRequest.php

  addAudio = save audio and cover file and put the returned id to $_POST -> insert all music data to database except genres -> insert genres to database -> return to admin homepage
  updateAudio = if a user inputs a new cover or audio file, save it and put it on $_POST, otherwise unset it -> put data from genre checkbox to a variable -> delete all previous music genres -> store new genres to database -> update music data -> return to homepage
  deleteAudio = delete audio file
  addStream = add stream data

**ratingRequest.php

  addRating = insert rating data -> return to music page
  deleteRating = delete rating data

  
