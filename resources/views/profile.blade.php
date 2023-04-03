<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
</head>
<body>
    <x-personal-information :name="$name" :email="$email" :phone="$phone" />
    <x-bio :bio="$bio" />
    <x-education-work-history :educationWorkHistory="$educationWorkHistory" />
    <x-skills :skills="$skills" />
</body>
</html>
