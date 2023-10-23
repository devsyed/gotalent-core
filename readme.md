Send Message into Thread 
http://gotalent.local/wp-json/better-messages/v1/thread/3/send - POST
Request Body
{
    "message":"Hello World",
    "meta":{}
}

Create Thread 
http://gotalent.local/wp-json/better-messages/v1/thread/new - POST

Request Body 
{
    "message":"Hello World",
    "recipients":[23],
    "subject":"New Message Check"
}


Integration BetterMessages with GoTalent 
When a recruiter sends an invite to a talent, it will also put 
the details into message and send it. It will also create a new invite request 
