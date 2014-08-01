Ext.syncRequire([       
	"Deft.mixin.Controllable", 
    "Deft.mixin.Injectable"
]);

Ext.define("Admin.Application", {
    name: 'Admin',
    
    requires: [
		"Deft.mixin.Controllable", 
	    "Deft.mixin.Injectable"
    ],

    extend: 'Cmf.app.Application'
});

