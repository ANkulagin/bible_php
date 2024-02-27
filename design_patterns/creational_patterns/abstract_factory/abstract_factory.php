<?php

interface  AbstractFactory
{
    public function makeDeveloperWorker(): DeveloperWorker;

    public function makeDesignerWorker(): DesignerWorker;
}
class OutsourceWorkerFactory implements AbstractFactory
{

    public function makeDeveloperWorker(): DeveloperWorker
    {
        return new OutsourceDeveloperWorker();
    }

    public function makeDesignerWorker(): DesignerWorker
    {
        return new OutsourceDesignerWorker();
    }
}
class NativeWorkerFactory implements AbstractFactory
{

    public function makeDeveloperWorker(): DeveloperWorker
    {
        return new NativeDeveloperWorker();
    }

    public function makeDesignerWorker(): DesignerWorker
    {
        return new NativeDesignerWorker();
    }
}

interface Worker
{
    public function work();
}

interface DeveloperWorker extends Worker
{

}

interface DesignerWorker extends Worker
{

}

class NativeDeveloperWorker implements DeveloperWorker
{
    public function work()
    {
        printf('i am developer as native');
    }
}

class OutsourceDeveloperWorker implements DeveloperWorker
{
    public function work()
    {
        printf('i am developer as outsource');
    }
}

class NativeDesignerWorker implements DesignerWorker
{
    public function work()
    {
        printf('i am designer as native');
    }
}

class OutsourceDesignerWorker implements DesignerWorker
{
    public function work()
    {
        printf('i am designer as outsource');
    }
}

$nativeDeveloper=new  NativeWorkerFactory();
$nativeDeveloper=$nativeDeveloper->makeDeveloperWorker();
$nativeDesigner=new  NativeWorkerFactory();
$nativeDesigner=$nativeDesigner->makeDesignerWorker();
$outsourceDeveloper=new  OutsourceWorkerFactory();
$outsourceDeveloper= $outsourceDeveloper->makeDeveloperWorker();
$outsourceDesigner=new  OutsourceWorkerFactory();
$outsourceDesigner = $outsourceDesigner->makeDesignerWorker();

$nativeDesigner->work();