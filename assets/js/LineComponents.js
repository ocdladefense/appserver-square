
function LineComponents(lineItems){
    return vNode("ul",{className:"lineItems"},
    lineItems.map( (lineItem,index) => 
        vNode("li",{className:"lineItem",id:"lineItem"+index},[
            vNode("div",{className:"col left"},[
                vNode("div",{className:"detail"},[
                    vNode("div",{className:"name"},
                        vNode("a",{href:"#"},lineItem["Description"])),
                    vNode("div",{className:"description"},"Product Code: "+lineItem["ProductCode"]),
                    vNode("div",{className:"price"},"$"+lineItem["UnitPrice"])
                ])
            ]),
            vNode("div",{className: "col right"},[
                vNode("div",{className:"quantity"},
                    vNode("input",{type:"text", className:"quantity", step:"1", value:"1"})),
                vNode("div",{className:"remove",name:"removeItem",id:"removeItem"+index},)
            ])
        ])
    ));
} 
function renderRemoveCartSvg(pageElement){
    let svg = document.createElementNS("http://www.w3.org/2000/svg", "svg");
    let polygon = document.createElementNS("http://www.w3.org/2000/svg", "polygon");
    svg.setAttribute("version","1.1");
    svg.setAttribute('viewbox', '0 0 60 60');
    svg.setAttribute('x', '0px');
    svg.setAttribute('y', '0px');
    svg.setAttribute('class', 'close');

    polygon.setAttribute('points', '38.936,23.561 36.814,21.439 30.562,27.691 24.311,21.439 22.189,23.561 28.441,29.812 22.189,36.064 24.311,38.186 30.562,31.934 36.814,38.186 38.936,36.064 32.684,29.812');
    svg.appendChild(polygon);
    pageElement.appendChild(svg);
}

//xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
//vNode("polygon",{points:"38.936,23.561 36.814,21.439 30.562,27.691 24.311,21.439 22.189,23.561 28.441,29.812 22.189,36.064 24.311,38.186 30.562,31.934 36.814,38.186 38.936,36.064 32.684,29.812"},)
//var rect = document.createElementNS("http://www.w3.org/2000/svg", "rect");
//var svg = document.getElementById('main');
//svg.appendChild(rect)