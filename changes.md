## CHANGES IN 1.8

- Routes Completely Recoded
	* Values can now be extracted from Routes
	* Introduced Wildcards in Routes
- Added Views Class
	* Now load views without blazer if you want.
	* Fixed Old Bug
- BLAZER
	* Added Turbo Mode in Balzer. Increased Speed 2x.
	* Renamed Dir name to avoid confusion.
	* Removed Blazer From Dependency
- A beautiful homepage added.
- Introduced changes.md


## CHANGES in   1.8.0.0 < changes <= 1.8.1.0
#### BLAZER
- NEW : Link css using {.file.css.}
- NEW : Link script using {#file.js#}
- NEW :Added JSON Based Autolaod Module for plugins
- Declare Autoload Config in `assets/plugins/autoload.json` files.
- Link Autoloads by `{plugin(bootstrap/autoload.json)}` SEE `application/public/home.blazer.html` for more.

#### Routes
- Added Post type route. Called when post request made.

#### Models
- Added file model

- Initialize the handler by:
~ $handler = new handler;

- Load a file as target by:
~ $handler->file('filename');

- Load the contents of target file by
~ $handler->file('filename')->read();

- To create new file
~ $handler->file('desired name')->create();

- To write to file
~ $handle->file('new_file.md')->write('i am yash');

- To append to previous data
~ $handle->file('file.md')->append('add this text');

- To Clear entire data but dont delete file
~ $handle->file('new_file.md')->clear();

- To delete file
~ $handle->file('new_file.md')->delete();