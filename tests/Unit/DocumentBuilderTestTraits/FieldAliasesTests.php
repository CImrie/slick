<?php


namespace Tests\Unit\DocumentBuilderTestTraits;


trait FieldAliasesTests
{
    protected $tests = [
        'binary'          => 'bin',
        'binaryByteArray' => 'bin_bytearray',
        'binaryCustom'    => 'bin_custom',
        'md5'             => 'bin_md5',
        'uuid'            => 'bin_uuid',
        'boolean'         => 'boolean',
        'collection'      => 'collection',
        'customId'        => 'custom_id',
        'date'            => 'date',
        'file'            => 'file',
        'float'           => 'float',
        'hashMap'         => 'hash',
        'integer'         => 'int',
        'key'             => 'key',
        'objectId'        => 'object_id',
        'raw'             => 'raw',
        'string'          => 'string',
        'timestamp'       => 'timestamp',
        'id'              => 'id',
    ];

    /**
     * @test
     */
    public function can_set_aliases()
    {
        foreach($this->tests as $method => $type)
        {
            $this->runTypeTest($method, $type);
        }
    }

    /**
     * @test
     */
    public function id_uses_mongodb_default_generation()
    {
        $this->runTypeTest('id', 'id');
        $this->assertEquals('set', $this->metadata()->fieldMappings['custom']['strategy']);
    }

    private function runTypeTest($method, $type)
    {
        $this->assertBuilder($this->builder->{$method}('custom'));
        $this->builder->build();

        $this->assertType($type);
    }

    private function assertType($type)
    {
        $this->assertEquals($type, $this->metadata()->fieldMappings['custom']['type']);
    }
}