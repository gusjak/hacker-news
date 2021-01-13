# Hacker News

<img src="https://media.giphy.com/media/MM0Jrc8BHKx3y/giphy.gif" width="50%">

## Assignment

You're going to create a [Hacker News](https://news.ycombinator.com/news) clone. Prepare a short presentation of your project which you're going to present for the entire class on January 14, 2021.

**The application should be written in HTML, CSS, JavaScript, SQL and PHP.**

<br>

## Features / User stories

- [x] As a user I should be able to create an account.

- [x] As a user I should be able to login.

- [x] As a user I should be able to logout.

- [x] As a user I should be able to edit my account email, password and biography.

- [x] As a user I should be able to upload a profile avatar image.

- [x] As a user I should be able to create new posts with title, link and description.

- [x] As a user I should be able to edit my posts.

- [x] As a user I should be able to delete my posts.

- [x] As a user I'm able to view most upvoted posts.

- [x] As a user I'm able to view new posts.

- [x] As a user I should be able to upvote posts.

- [x] As a user I should be able to remove upvote from posts.

- [x] As a user I'm able to comment on a post.

- [x] As a user I'm able to edit my comments.

- [x] As a user I'm able to delete my comments.

<br>

## Extra Feature / User stories

- [x] As a user I'm able to delete my account along with all posts, upvotes and comments.

<br>

## Installation Guide

1. To be able to view this webpage, clone this repository through the terminal.

```
$ git clone https://github.com/gusjak/hacker-news.git
```

2. Change your current directory to the newly cloned repo.

```
$ cd hacker-news
```

3. Start your own localhost server (8000 is standard).

```
$ php -S localhost:8000
```

4. Open the index.php file in your browser.

```
localhost:8000/index.php
```

<br>

## Testers

1. [Jonathan Larsson](https://github.com/Icarium2)
2. [Hugo Sundberg](https://github.com/Hugocsundberg)

<br>

## Code review

[Ida From](https://github.com/Fvrom)

Snyggt Jakob! Svårt att hitta något du bör ändra egentligen, här kommer lite små ting! 
- I userposts ser jag du deklarerat userId och currentId med din Session user id, alltså att du deklarerat om den variabeln. Jag har svårt att se vad currentId har för nytta, utan att man istället bara använder sig av userId. 
- I din upvotesindex ser jag att repeterat kod som du har i din function alreadyUpvoted. Man hade bara kunnat köra den funktionen så slipper man en upprepning av kod där. 
- I din updateavatar stötte jag på ett nytt sätt att skriva not type jpg/png, detta vet jag inte om det går? Jag testade genom att ladda in en js fil här istället för jpeg eller png och den verkar ha gått igenom med en successful message. i image src ser jag nu istället .js, men inget har dock hänt på backend. 
 
- En små grej, men det hade varit roligt om man kunde granska sin profil istället för att direkt hoppa in i settings!  
- Ser att du vill få ut "comment" när det är 0 kommentarer på en post och "comments" om det är kommentarer på en post. Detta verkar inte fungera för mig förrän jag ändrar koden till numberofComments < 1 
- Kanske ännu fler fixes i register, möjligtvis en gräns på vilka characters man får använda i username och en max och minimum characters på username / password! 
- Snyggt att man kan hoppa in och granska sina posts om man klickar på sin profil! 
- Supersnyggt med att du sätter in en default avatar när man registrerar sig! 
- Superbra jobbat, snygg och clean kod! 

<br>

## License

This project is licensed under the MIT License - see the **[LICENSE](https://github.com/gusjak/hacker-news/blob/main/LICENSE)** here.
