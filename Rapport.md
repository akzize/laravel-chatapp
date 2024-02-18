first thing we've done is aetting up our environment of work,

we used a server called synology, which is a NAS server, to store our data and to work on it.

we used a software called "Git" to manage our project, it's a version control system, it allows us to work on the same project at the same time without any conflict, and it also allows us to go back to a previous version of our project if we want to.

we used a software called "Docker" to create a container for our project, it's a tool that allows us to create, deploy, and run applications by using containers.

Because the code is only the server we used a codeserver container to edit the code and to run it.

so every memeber work on his own container and then we merge the code together.

we use a self hosted git server to store our code and to work on it, called "Gitea".
we set up in a docker container.

So, the structure is like this:
- we have a server called synology, which is a NAS server, to store our data and to work on it.
- we have a self hosted git server to store our code and to work on it, called "Gitea".
- every member has his own code container and an other container for codeserver to edit the code and to run it.
- when the function is done, we make a pull request to merge the code together.
- and then we pull it the production container.

