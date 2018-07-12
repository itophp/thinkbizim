# 首页数据接口

{% api-method method="get" host="https://api.cakes.com" path="/" %}
{% api-method-summary %}
 获取首页数据
{% endapi-method-summary %}

{% api-method-description %}
This endpoint allows you to get free cakes.
{% endapi-method-description %}

{% api-method-spec %}
{% api-method-request %}

{% api-method-response %}
{% api-method-response-example httpCode=200 %}
{% api-method-response-example-description %}
Cake successfully retrieved.
{% endapi-method-response-example-description %}

```javascript
{
    "data": {
        "swipers": [
        {
            "id": 17,
            "ad_name": "手机端Banner1",//广告名称
            "ad_title": "手机端Banner1",
            "ad_link": "http://",
            "ad_pic": "http://api.yjh.m.com/uploads/image/20171227/b2e2eec8828636c919470fc623fb7ecb.jpeg",
            "ad_video": "http://",
        },
        ...
        ],
        "nav": [
        {
            "id": 18,
            "pid": 0,
            "parent_tree": "0",
            "position": "16",
            "name": "团购",
            "alias": null,
            "icon": "http://api.yjh.m.com/uploads/image/20171227/8e4d34eab441c9191756c786d83bfe21.png",
            "html_name": null,
            "link": "/shop/index/group_buy",
            "link_type": "5",
            "link_param": "",
            "link_extra_param": "",
            "start_time": 0,
            "end_time": 0,
            "sort": 100,
            "trash": 0,
            "status": 1,
            "description": ""
        },
        ...
        ],
        "recommend_goods": {
            "first": {
                "url": "",
                "thumb": "http://api.yjh.m.com/picture/admin/454c39dd3bff2d14b98c70a89d8fa8aa.png"
            },
            "others": [
            {
                "id": 1003, // 产品ID
                "title": "正楷仓鼠水晶跑球 仓鼠玩具 仓鼠跑轮 仓鼠跑球...",// 产品标题
                "status": 1,// 产品状态
                "goods_remark": "",// 产品备注
                "goods_sn": "2017111515450535808",// 产品编号
                "cat_id": "2",// 产品分类ID
                "brand_id": "0",// 产品品牌ID
                "market_price": "0.00",// 产品原价
                "shop_price": "18.00",// 产品现价
                "cost_price": "15.00",// 产品邮费价格
                "thumb": "http://api.yjh.m.com/uploads/goods/20171115/f171492094bb87384e47188656d728a8.png",// 产品主图
                "is_free_shipping": 0,// 是否包邮
                "sales_sum": 0,// 销售数量
                "stock": 10,// 库存
                "give_score": 0,// 赠送积分
                "need_score": 0,// 需要积分（积分商城使用）
                "is_comm": 0,// 是否是推荐商品
                "is_new": 0,// 是否是新品
                "is_hot": 0,// 是否是热门产品
                "max_buy": 0,// 最大购买数量
                "mp_content": null,// 小程序内容
                "bzqd": null
            },
            ...
            ]
        },
        "banners": [
            {
            "id": 21,
            "ad_name": "首页中间广告",
            "ad_title": "首页中间广告",
            "pid": 2,
            "media_type": 0,
            "ad_link": "http://",
            "ad_pic": "/picture/admin/370d16e29e938bd6ac749a697cf4cbc4.png",
            "ad_video": "http://",
            "start_time": 1523265045,
            "end_time": 1617959447,
            "link_man": "",
            "click_count": 0,
            "isdspy": 1,
            "sort": 50,
            "target": 0,
            "bgcolor": null,
            "img": "http://api.yjh.m.com/picture/admin/370d16e29e938bd6ac749a697cf4cbc4.png"
            },
            ...
        ]
    }
}
```
{% endapi-method-response-example %}

{% api-method-response-example httpCode=404 %}
{% api-method-response-example-description %}
Could not find a cake matching this query.
{% endapi-method-response-example-description %}

```javascript
{
    "message": "Ain't no cake like that."
}
```
{% endapi-method-response-example %}
{% endapi-method-response %}
{% endapi-method-spec %}
{% endapi-method %}



