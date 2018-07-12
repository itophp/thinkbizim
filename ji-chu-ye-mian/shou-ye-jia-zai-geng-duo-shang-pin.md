# 首页加载更多商品

{% api-method method="get" host="https://api.cakes.com" path="/shop/index/movegoods" %}
{% api-method-summary %}
首页最下方加载更多产品界面
{% endapi-method-summary %}

{% api-method-description %}
This endpoint allows you to get free cakes.
{% endapi-method-description %}

{% api-method-spec %}
{% api-method-request %}
{% api-method-query-parameters %}
{% api-method-parameter name="page" type="number" %}
当前页数，默认为1页
{% endapi-method-parameter %}
{% endapi-method-query-parameters %}
{% endapi-method-request %}

{% api-method-response %}
{% api-method-response-example httpCode=200 %}
{% api-method-response-example-description %}
Cake successfully retrieved.
{% endapi-method-response-example-description %}

```javascript
{
    "code": 200,
    "data": {
        "goods_list": [
            {
                "id": 1003,
                "lang": 1,
                "name": null,
                "title": "正楷仓鼠水晶跑球 仓鼠玩具 仓鼠跑轮 仓鼠跑球 仓鼠笼仓鼠窝仓鼠用品仓鼠运动玩具 仓鼠跑球",
                "sort": 100,
                "goods_remark": "",
                "goods_sn": "2017111515450535808",
                "cat_id": "2",
                "cat_tree": "0,2",
                "market_price": "0.00",
                "shop_price": "18.00",
                "cost_price": "15.00",
                "thumb": "/uploads/goods/20171115/f171492094bb87384e47188656d728a8.png",
                "sales_sum": 0,
                "stock": 10,
                "is_comm": 0,
                "is_new": 0,
                "is_hot": 0,
                "mp_content": null,
                "bzqd": null
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



