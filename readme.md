# Havenly Backend Engineering Test
This test is to help gauge your level of ability for the context of a Havenly Backend Engineering
position. We are looking for code quality and to assess your thinking. You are more than
welcome to solve the problems below in any way you would like. The problem described below
should not take longer than 3-4 hours to complete.

Problem:
Given a CSV:

* Process the data into a db table
* Serve up the data via a public API (dumping a raw json string to an html page is
sufficient here)
The CSV contains the following fields => type in this order:
* sku => string
* title => string
* price => float
* description => string
* availability => boolean
* color => string
* dimensions => string
Your processor must:
* Create a new record if the sku does not exist in your db
* Update the price and availability if the record does exist in your db

Please describe your data structure you chose for storing the data.

1. What are the advantages to your database design?
  * I'm using a single table so all my data is in one place and I do not have to
  worry about doing joins across multiple tables, which simplifies my datamapping
  * I don't have to worry about foreign key relationships breaking if a table is
  dropped in the future
1. What are the drawbacks?

  * If there are only one or two columns that are constantly being updated then it
  will technically be slower to read/write to the larger table, when it could be
  faster to have those columns on their own table.
  * Because the updated timestamp only applies to the whole row, we cannot tell
  when individual columns were last updated.
  * Querying specific columns might technically be faster under certain circumstances
  if those columns were in their own table with their own incrimented primary key

Please describe the API you built.

2. Did you use any frameworks?

    2. If so, why? And why did you select the one you did?
    I chose to use the Laravel 5 MVC framework.  Specifically I chose the framework
    for 4 reasons.  

    First, because Laravel is setup using composer you can easily
    find and install pacakages/dependencies that allow you to shortcut your development of
    an MVP.  In my case I didn't want to code the logic of processing a csv file,
    so I added the Maatwebsite ExcelServiceProvider package to my project and used
    it to handle the upload of the csv file.  The only disadvantage here is that
    if something doesn't work you then have to debug a package you are completely
    unfamiliar with.  That can in some cases take longer than simply coding a
    solution that does what you want from scratch.  However the nice thing about
    packages like that is that there are often more than one, so if the one you use
    doesn't work for you, you can see if another solves your problem.

    Second, Laravel's routing makes urls MUCH cleaner in my opinion.  Although
    this project isn't a great example, if, for example, I wanted to do an api
    call to delete a row based on a sku I could use a route like
    /products/delete/sku/12345
    instead of
    products.php?delete=1&sku=12345
    it doesn't make a huge functional difference, but with code cleanliness comes
    easier documentation which is critical to any project

    Third, Laravel uses Eloquent ORM, which is an active record pattern that allows
    me to simply ask for the data in the model and get all records.  Similarly
    to update or insert into the database, I only need to work with the model.
    This helps simplify the code.  The danger is that it can hamstring me if I
    need to do more complex queries (using joins for example).  Fortunately,
    I can still do raw queries with Laravel via the DB facade, so although it's not
    perfect, I feel Eloquent is an improvement over a vanilla approach.

    Fourth, Laravel's routing of views makes it very easy to allow/disallow REST
    calls and offer up custom responses.  For instance in this project, when accessing
    the /import route as a GET request, you get the file upload view, but when
    accessing as POST, it instead routed to a separate function.  While in this case,
    that's not much different from posting to the same file your view is built
    on in a vanilla PHP solution, it does allow more flexibility for which methods
    and which controllers you pass your view's data to.

    2. If not, why not?
    N/A

    2. What are the Pros/Cons to the API you built?
      * Pros
        * Larvel is an out of the box solution that allows us to rapidly prototype
        different solutions and functionalities, much more so than a vanilla approach
        * Code is abstracted and modularized because of the MVC approach
        * Can be quickly setup in any linux environment with composer, and allows
        the environment to be standardized for devs
      * Cons
        * Using a relational database like MySQL could result in very slow load
        times, especially with calls that dump entire tables.  Using Redis, or
        another NoSQL approach would likely be better for speed, though that would
        hinder a relational approach in code, as well as prevent us from being
        able to use transactions
        * An abstracted and modularized approach to not just code, but db queries,
        can make onboarding and development of new/junior developers more difficult,
        as it is a higher technical barrier.
