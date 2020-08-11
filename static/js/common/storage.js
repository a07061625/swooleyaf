/**
 * 存储操作,封装storage的相关操作
 * Author: 姜伟
 * Date: 2020-08-10
 */

/**
 * 存储类继承
 * @param Child
 * @param Parent
 */
function inheritStorage(Child, Parent) {
    var F = function() {};
    F.prototype = Parent.prototype;
    Child.prototype = new F();
    Child.prototype.constructor = Child;
}

/**
 * 存储基类
 * @param props {{}} 初始化属性,json对象
 * @constructor
 */
function SyStorageBase(props) {
    this._syname = '';
    if (typeof props.name === 'string') {
        this._syname = props.name.trim();
    }
    if (this._syname.length === 0) {
        throw '存储标识不能为空';
    }
    
    //设置存储前缀
    if (typeof props.prefix === 'string') {
        this._syprefix = props.prefix;
    } else {
        this._syprefix = 'sys';
    }
    this._sytag = this._syprefix + this._syname;
    
    //设置存储类型 local:localStorage session:sessionStorage
    this._sytype = 'local';
    
    //设置存储格式 text:文本 json:json
    if (props.format === 'text') {
        this._syformat = 'text';
    } else {
        this._syformat = 'json';
    }
    
    //设置存储时间,单位为秒
    if ((typeof props.expire === 'number') && (props.expire >= 1)) {
        this._syexpire = parseInt(props.expire);
    } else {
        this._syexpire = 7200;
    }
}

/**
 * 获取存储数据,如需自动更新,子类需要实现refresh方法
 * @returns {null|*}
 */
SyStorageBase.prototype.get = function() {
    var content = null;
    if (this._sytype === 'local') {
        content = localStorage.getItem(this._sytag);
    }
    
    //本地存储已设置且没有超时
    if (content !== null) {
        var nowTime = parseInt(new Date().getTime() / 1000);
        var contentData = JSON.parse(content);
        if (contentData.etime > nowTime) {
            return contentData.data;
        }
    }
    
    //设置了缓存刷新回调方法
    if (typeof this.refresh === 'function') {
        var refreshData = this.refresh();
        this.set(refreshData);
        return refreshData;
    }
    return null;
}

/**
 * 设置存储数据
 * @param val {*} 待设置的数据
 */
SyStorageBase.prototype.set = function(val) {
    var setTag = true;
    var content = {
        etime: parseInt(new Date().getTime() / 1000) + this._syexpire,
        data: ''
    };
    if (this._syformat === 'json') {
        content.data = val;
    } else if (typeof val === 'string') {
        content.data = val;
    } else {
        setTag = false;
    }
    
    if (setTag) {
        if (this._sytype === 'local') {
            localStorage.setItem(this._sytag, JSON.stringify(content));
        }
    }
}

/**
 * 移除存储数据
 */
SyStorageBase.prototype.remove = function() {
    if (this._sytype === 'local') {
        localStorage.removeItem(this._sytag);
    }
}

/**
 * 存储管理类
 * @type {{}}
 */
SyStorage = {
    list: {},
    getObj: function(name) {
        if (this.list.hasOwnProperty(name)) {
            return this.list[name];
        } else {
            return null;
        }
    },
    setObj: function(name, obj) {
        if (obj instanceof SyStorageBase) {
            this.list[name] = obj;
        }
    },
    get: function(name) {
        var obj = this.getObj(name);
        if (obj !== null) {
            return obj.get();
        } else {
            return null;
        }
    },
    set: function(name, val) {
        var obj = this.getObj(name);
        if (obj !== null) {
            obj.set(val);
        }
    },
    remove: function(name) {
        var obj = this.getObj(name);
        if (obj !== null) {
            obj.remove();
        }
    }
};

//--------------------------------------------------后续为各个存储子类的实现-----------------------------------------------
//角色功能列表存储子类实现
/**
 * 角色功能列表存储类
 * @constructor
 */
function SyRoleFunctionListStorage() {
    SyStorageBase.call(this, {
        name: 'a001'
    });
}
//所有的存储类必须继承存储基类
inheritStorage(SyRoleFunctionListStorage, SyStorageBase);

/**
 * 刷新角色功能列表
 * @returns {*}
 */
SyRoleFunctionListStorage.prototype.refresh = function() {
    var functions = {};
    $.ajax({
        url: ctx + '/api/AdminRoleAccount/getPermissionFunctionList',
        type: 'get',
        data: {},
        dataType: 'json',
        async: false,
        success: function (res) {
            functions = res.data;
        },
        error: function (res) {
        }
    });
    
    return functions;
}
SyStorage.setObj('role_functions', new SyRoleFunctionListStorage());

//其他存储子类实现

/**
 * 使用
 */
//<script src="/path/to/storage.js"></script>
//<script>
//    //获取角色功能列表
//    SyStorage.get('role_functions');
//</script>
