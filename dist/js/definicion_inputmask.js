Inputmask.extendAliases({
     'dinero': {
        alias: "numeric", //it inherits all the properties of numeric    
       "groupSeparator":".",//overrided the prefix property   
	   "radixPoint": ",",
	   "prefix":"$",
	   "autoUnmask": true
	  }
});