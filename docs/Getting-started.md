# Getting started guide

## What is ZfcDatagrid and what is it not?
First i want to clarify that ZfcDatagrid is **NOT a CRUD abstraction**, 
it's here to **read data from different sources and display it in different output formats (HTML, PDF, Excel, ...)**.

## Installation
If ZfcDatagrid is not installed already, please continue reading here https://github.com/ThaDafinser/ZfcDatagrid#installation

```sh
If you want to use the JqGrid, please include the JS/CSS files on your own (it's not part of ZfcDatagrid)
```

## Your first datagrid
The first datagrid is a really simple one, to see if everything works for you. 
It'll work if you have ZF2-Skeleton installed or Twitter Bootstrap included out of the box.

You find this example here https://github.com/ThaDafinser/ZfcDatagrid/blob/master/docs/Grid-minimal.md

After you have copied it into your module, make sure the controller is registered and the routing works.

Now you can try to call this action (with your defined route) and you should see your first ZfcDatagrid! (Congratulations)
It's renderer with the output mode "bootstrapTable", where you can already paginate or sort your data...

## Create your custom/own grid
(i don't have more time, so this will come later...)
You find more examples here: https://github.com/ThaDafinser/ZfcDatagrid/tree/master/src/ZfcDatagrid/Examples/Controller

There are also database sources (Zend/Doctrine) and JqGrid as output mode.

Have fun so far :-)
