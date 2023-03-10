# Noob
#### By Emilia Aboudara, Igor K, Sasha Ilinskaya

A social review and collection management site for video games. Based loosely on the film review site [Letterboxd](https://letterboxd.com), the site will allow users to add games from many different systems to their “collection”, keep track of their play status (planning, currently playing, completed, etc), and write reviews for other users to browse. Users can follow their friends to populate a “feed” of recent reviews and status changes (i.e. “Jon added this game to their wishlist/bought this game/beat this title”). Admins & game developers have access to an additional page to add new titles to the game database, as well as a link on existing game pages to edit their info.

## Database map
[Table](https://docs.google.com/spreadsheets/d/19hP2Bb4KzfSO_JUKoqC7ByUzqc5P6xMIGOwNsNkhhzA/edit?usp=sharing)

## Model functions
- Login modal
    - getUser(name)
- Register.php
    - addUser(name, pw, email, is_admin)
- Game.php
    - getGame(title)
    - getReviews(game_id)
    - addReview(user_id, game_id, rating, review)
- Library page
    - getAllGames()
    - getRatings(game_id)
- Admin interface
    - addGame(title, synopsis, img, developer, publisher, platforms, released, genres, notes)