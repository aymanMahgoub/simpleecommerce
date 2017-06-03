let windowLocation = function(){
	let pathname = window.location.pathname.trim();
	let pathnameArray = [];
	makePathnameArray();

	function makePathnameArray(){
		if(isLastCharSlash()){
			removeSlash();
		}

		pathnameArray = pathname.split('/');
		for(let i = 0 ; i < pathnameArray.length ; i++){
			pathnameArray[i] = pathnameArray[i].toLowerCase();
		}
	}

	function isUpdatePath(){
		if(pathnameArray[pathnameArray.length-1] == 'edit'){
			return true;
		}
		return false;
	}

	function isCreatePath(){
		if(pathnameArray[pathnameArray.length-1] == 'create'){
			return true;
		}
		return false;
	}

	function getResourceId(resourceName){
		let resourceIndex = pathnameArray.indexOf(resourceName.toLowerCase());
		if(resourceIndex != -1 && !isNaN(pathnameArray[resourceIndex+1]) ){
			return pathnameArray[resourceIndex+1];
		}
		return false;
	}

	function removeSlash(){
		pathname = pathname.slice(0 , pathname.length-1);
	}

	function isLastCharSlash(){
		if(pathname[pathname.length-1] == '/'){
			return true;
		}
		return false;
	}

	function isIndexPath(){
		if(
			pathnameArray[pathnameArray.length-1]    != 'edit' 
			&& pathnameArray[pathnameArray.length-1] != 'create' 
			&& isNaN(pathnameArray[pathnameArray.length-1])
		){
			return true;
		}
		return false;
	}

	function isShowPath(){
		if(
			pathnameArray[pathnameArray.length-1]    != 'edit' 
			&& pathnameArray[pathnameArray.length-1] != 'create' 
			&& !isNaN(pathnameArray[pathnameArray.length-1])
		){
			return true;
		}
		return false;
	}

	function getCreatePath(){
		if(isCreatePath()){
			return pathnameArray.join('/');
		}else if(isIndexPath()){
			let createPathNameArray = pathnameArray;
			createPathNameArray.push('create');
			return createPathNameArray.join('/');
		}
	}

	function getIndexPath(){
		if(isIndexPath()){
			return pathnameArray.join('/');
		}else if(isCreatePath()){
			let indexPathNameArray = pathnameArray;
			indexPathNameArray.pop();
			return indexPathNameArray.join('/');
		}
	}

	return {
		isUpdatePath  : isUpdatePath, 
		isCreatePath  : isCreatePath,
		isIndexPath   : isIndexPath,
		getResourceId : getResourceId,
		isShowPath    : isShowPath,
		getIndexPath  : getIndexPath,
		getCreatePath : getCreatePath
	};
};