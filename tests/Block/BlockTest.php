<?php


namespace BitWasp\Bitcoin\Tests\Block;

use BitWasp\Bitcoin\Block\Block;
use BitWasp\Bitcoin\Block\BlockFactory;
use BitWasp\Bitcoin\Block\BlockHeader;
use BitWasp\Bitcoin\Math\Math;
use BitWasp\Bitcoin\Tests\AbstractTestCase;
use BitWasp\Bitcoin\Transaction\TransactionFactory;
use BitWasp\Bitcoin\Transaction\TransactionInterface;
use BitWasp\Buffertools\Buffer;

class BlockTest extends AbstractTestCase
{
    private function getBlockHeader()
    {
        return new BlockHeader(
            3,
            Buffer::hex('00000000000000000de6926c80141b69e9a42025ac64b1513e138b8c69ca8df5', 32),
            Buffer::hex('5058c1ce878af3efe8cc78493e7362d11d7fd4e4414f70669a86287556c3cbcd', 32),
            1431097669,
            0x181713dd,
            1582016577
        );
    }

    public function testSetHeader()
    {
        $header = $this->getBlockHeader();
        $txs = [];
        $block = new Block(new Math(), $header, ...$txs);
        $this->assertSame($header, $block->getHeader());
    }

    public function testGetTransactions()
    {
        $header = $this->getBlockHeader();
        $block = new Block(new Math(), $header);

        $this->assertInternalType('array', $block->getTransactions());
        $this->assertEmpty($block->getTransactions());
    }

    public function testSetTransactions()
    {
        $hex = '0100000014e3b8f4a75dd3a033744d8245148d5a8b734e6ebb157ac12d49e65d4f01f6c86c000000006c493046022100e8a2df24fd890121d8dd85c249b742d0585ec17d18b1bf97050e72eaaceb1580022100d7c37967048a617d7551c8249ea5e58cbf71a0508a6c459dd3a9dfefba3c592f0121030c51892ad8c9df7590c84bc2475576d6dc0815a5bf3ca37f1c58fe82e45d9ef5ffffffff0f1408fa2773334487d1d37e45cb399d049c7e46db3faadfcc204656bce57f5e000000006b483045022100cc339da0e9330b2375124a5fae678b130a4e5215310d85a1db2c7da32dd9633a02205fb02c932eab91733920bab341ad61097f2ff5dc73e46577ce3b70fd0e2ecc4b0121033fd9e31bd2bdc7029d6f1cca55655c4b484aca7fdea11547b37a4aeaf347e132ffffffff72a329f6d5cb92a3cd9e8aa252f0c683f28cb57e8884cfff42ffdddaca86f2e4000000006a473044022013f6b4e159ba9f88825746f9c7d1131cb14667a83d6b3871b5bab2a8f9f75759022024e29aa4bb7c7b994468c0a7a7add2bb180fc9a48b0187d2e06239b358cce8eb0121037cf462b312b1696f2654a21100a6a726238b91455d0f50f69526335d9022fdc5ffffffff49d1bb27b1027249326f3ad35a06b3c7fc9af2c0318caa02c1a90ae2e2a46cf8000000006c493046022100b6381612d4a5b1c75d57fdf93ce8fe39d4541a97af5cd312dbd91925cbd2037e022100a32954780c7d711059524f03ed78cf2e234554977a7e2139e7e7c6949835da660121025a4098ac03d3f706bfdaa795f80350aad15b5a6a578cee2991c16edae0255e76ffffffffc6b749366d13fca59f264b2714bc090660eb291361f23d79b6515f48f35dfd2c010000006b48304502205421f94ee54d829f921785860d4603b82caf8f3722f768e26970f4baa625c0dc022100f3c0cee26b1a98558386fbfcb568100582acc7bc8423e3402313298e0a3291520121026bff9f45e1645a6a67f70e80439d982d3d6dd0fe31258f93ae65161a14b54648ffffffff1f48a79c65634eb19c4a7eaca76a3f8f7c47b649cf54c8fbb5be6f87f6a42fa7010000006a47304402207907ec39e5ff6a85c5c0e5b8d7a81750e1e450e85839d87cdde4cfba405f6ee602205439aa642218bb676d2d2b9c0c63dd44395ad85fad2954ac1794bb4b35e134fc0121033fd9e31bd2bdc7029d6f1cca55655c4b484aca7fdea11547b37a4aeaf347e132ffffffff3a339577e45201a85797937aa44fe7a31f9240ba8a9169e46c32bbd82fbc2ae3000000006a473044022018e0dbfb5ee617fb7d1c28c672fb5428cbc1edb6ed8cc76bc68682432c4bfe450220187a7d4e7b2af69a8e7c7ebfd1b6f02143cf7a32c1041c01bc5324bcd97101880121033fd9e31bd2bdc7029d6f1cca55655c4b484aca7fdea11547b37a4aeaf347e132ffffffff7d0e4f252c644d051e35ee839abde736f26dd2046c7ca18711c759e3c86fb15a220000006a473044022004dfb719c5afca95db100f4e55fb4dd27f4f9faf1a6eff390d9bbdbf9b28fa4b02206dfd0d5f74b4c6d8424d44461c6a230fc174902d2be8d1792e029c3d67a1be9601210388da4b2db35387cf3bfc786453e8ca952b5386c95ce1b39e7ff5cf62cb7033fbfffffffff009c6f8a9b86d97989eaaacf3ada9f9428bae3a1a01339b85fa541680271c3a000000006b48304502203c17278401d3f7e6ab56597b6b88c783db5aa534897954e92a95732b5d714a860221008be28d72988a8ba69ff3889337468df0e83612e9cfbead9118fb8f4decfb3e93012102cda10f1505ff6a3613f6aa31becba07e44eddc25110ae083e360577556f0178dffffffff75068f094fd516d1658dac8c88ae027852a84423831b780925fb3d591a308227010000006b48304502203ce1a111748534bc601cc4a879f4097b098f7622d28a3da89ac7b90f3b29ee52022100b7de6a03241f6fea37179c3b2f68f45b69c963edc19dc0b3b0350bb8ffbd9063012102c64a6d411eef9f79890d317ad72329608be5f58f6757e1c5c6d4f21076345ddcfffffffffc844c99e1adab4677dda6b5def33ce549293a40d08da6a8c36fb9274c76ba43000000006c493046022100ee2b946560aced0633a5151f1fa5dd0249d68bef420e43e1f7edfd0e83619cfd022100a433121fb022efb69043310bd982a842e7f5be737069d3535962ecd78c4954070121033fd9e31bd2bdc7029d6f1cca55655c4b484aca7fdea11547b37a4aeaf347e132ffffffff32f65f550d4ef09e451303af1d2f9964b4f62e7b6562d5dbe23d4be89ae32e36010000006b483045022100bb4b1af8c22e51e9a3f71fb2cd883746e3812cbfd6a0695bbd22e53d573cb6f20220539e478519411e1d277a844810ab756004cc7755ff585cda7aa2c9d93ab4570b01210290a17b828f33417e7e3cb179bd50a621c8381964e6e239e91eacf3f414018770fffffffff6a6dafe0ae32f6c891de86c4aa12b318eeb89ca4d8792906ae03fd0db04c76f010000006b48304502203dfe2f1d58fdcab2f67f079c14a26c69e88718d38615d5de8230ee74c1e55d9e022100bc7651cf77f142366b502c65c59790a3d2cfa52852feab04212d3ea68e040be0012103214083806ce8aebf35544845c73f1e9d4dcad2fc6057e6cda963498f5420fef9ffffffff11c3e0e2a520bd829fab9b4311e603de79ce1304e1f28204334f79d1fd2c9138010000006b48304502206196ca600a02bf7fd210489e520b915b521dfa84a37bf56f2022aa8e89d62e6f022100949aabaafe92aaa8e207f0699a4745179fdc34a475d5c783785a58744ed5dd410121033fd9e31bd2bdc7029d6f1cca55655c4b484aca7fdea11547b37a4aeaf347e132ffffffff54dffe807c0b935528100313322949738717dc2af2f374f2a72af24b82291f70000000006b483045022100b84abff6f636082d2b85da4de25de13388a7901f0df5b87d871305e694667b4f0220477619c2140bc2d7dfab0d2b7d49f0729afb951831c7a64ee4bede7d8a46960b012102cda10f1505ff6a3613f6aa31becba07e44eddc25110ae083e360577556f0178dffffffff9923148b409a0888e42612e964216eb575b8fe4d0cfe5aad84323962c219373b000000006b483045022100cc88b67cce1655c38c60ada140b9c34343411cc309c45410edf2b4f133520c03022044c3554a294f6a412219b710689d67c5d8519fc6a139ee311985a14b8b55fd6f012102cda10f1505ff6a3613f6aa31becba07e44eddc25110ae083e360577556f0178dffffffff5bb09bbcbdd756af1f08457f7c1319aa67d5488f359b58e6f36920b808c789bb010000006a473044022051b255884c8f118780e394c054c5df12d813e3b9983a9854c89e7ffd015cbf5702200ed58fac38a91e19d755d30d910a04aa29848608b72f99aef68e0ecedcbdca53012103f57996ef25762717a75b6d75f0166a33f775783766513118b5476933d7af8078ffffffffc3c978e2e413506b75b7882cc38cf6f40d199c7226f73b5e4ab8295703fd4b03d50000006b48304502201a07c4ce0f76c4f5d96c45811bfa08c00483c987e1297324f40136a4c452c306022100d553873b6b3c20ae2b6a588704bae9daa5093b17283e0b196a27d6e4022ff8a50121032beebbe7e386f1fd27a9a3e59640deaa5f60835ab789012175c0f517149c77e3ffffffff3944343f32f93d43752bea7d916571e236295fbff53c7a9133d09f741116fac5000000006b483045022074aac638f77fed744feb1e99f4a71f20278686fc2f91264058facd9983cde9fb0221008250b8d62dbb8d3954517f9f80e236d1c74720723459b5d69656dadf781ee2e9012102cda10f1505ff6a3613f6aa31becba07e44eddc25110ae083e360577556f0178dffffffff781119976951dfc6f8a617077068fcb623475acef7eff09808a5ef3281a0ef70010000006b48304502200236e5c6b0787756449043fd413307c176be2b39fb7da11a18e10708a72877fe022100836b99f32532039e6326cbf282cbf78140c53883c474443bd6e6145e52dfb08d012103dd033367f07aee4f365a47cdf3c45147887492c6d20788970296d3b94eb1cfd8ffffffff1365487900000000001976a9143f6cd41f7caeda87b86bc9e009295f179612f45488acc7440f00000000001976a914df90390bee06889ed003b3c4d024a9fd211cf96788ace0ee4504000000001976a9141d8aa01e6628f333fd6fd9d3b88c3f761869caa488acd5080200000000001976a91412d24a8a61e1cd37825fd31bd61eebc2c32ad77688ac0842b582000000001976a9147fb7cccd54bf322ddae63b6b2e20a3624622091888acd5113916000000001976a914e75fa783b5b319578a53f2f18c37d88513d060b088ac80969800000000001976a9140ce8c479dad1b78baeea2217af17655b908b59b888ace8fb1204000000001976a9141a80a0ee9b4f1d03c3fb2220e4124d441431d41888ac00e1f505000000001976a914b1fdf35dd37a1a5359ad829f5f43760cd1ea61d588ac80626a94000000001976a9142a929cae46f0b4e5742ae38d6040f11a2b70e7d188ac109d0a02000000001976a914a4b5bfbe26ef9ac8d6e06738b50065b25f3dcce288acab110400000000001976a9146fbc4dd98c194853dc9a3e6f195bddad8eef609788ac00e1f505000000001976a914e1733c6b9e4c98f4ddc19370dd5cae0727af04e788ac5d44d502000000001976a9147514615f455bdfb8b9da74c7707ef0426606c33288ac404b4c00000000001976a914166e78015832ba760593bb292993391d4554a39a88acf0190b01000000001976a91409859ea62e00e0531873c135e37efbeca610d36788ace2fcae8f000000001976a914b40d92da29c478049a8d15bfd85b6ce230863df288acc07a3e22000000001976a9141e12d7845e76857bfba94079c1faca68b3ae24c088ac9e130e01000000001976a9144bdb0b7712726c2684461cd4e5b08934def0187c88ac00000000';
        $tx = TransactionFactory::fromHex($hex);

        $txCollection = array($tx);
        $header = new BlockHeader(
            1,
            Buffer::hex('00000000aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', 32),
            Buffer::hex('12345678aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', 32),
            1,
            0,
            1
        );
        $block = new Block(new Math(), $header, ...$txCollection);
        $this->assertSame($txCollection, $block->getTransactions());
    }

    public function testGetMerkleRoot1Tx()
    {
        $hex = '010000000462442ea8de9ee6cc2dd7d76dfc4523910eb2e3bd4b202d376910de700f63bf4b000000008b48304502207db5ea602fe2e9f8e70bfc68b7f468d68910d2ff4ac50294fc80109e254f317f022100a68a66f23406fdfd93025c28ffef4e79260283335ce39a4e8d0b52c5ee41913b014104f8de51f3b278225c0fe74a856ea2481e9ad4c9385fc10cefadaa4357ecd2c4d29904902d10e376546500c127f65d0de35b6215d49dd1ef6c67e6cdd5e781ef22ffffffff10aa2a8f9211ab71ffc9df03d52450d89a9de648fdfd75c0d20e4dcb1be29cfd020000008b483045022100d088af937bd457903391023c468bdbb9dc46681c3c83ab7b101c26a41524a0e20220369597fa4737aa4408469fec831b5ce53caee8e9fec81282376c6f592be354fb01410445e476b3ea4559019c9f44dc41c103090473ce448f421f0000f2d630a62bb96af64f0fde21c84e4c5a679c43cb7b74e520dad662abfbedc86cc27cc03036c2b0ffffffff067b1e03bd8edc0496b41af958fead9d57489fa12d23f4b341ded9b78d8cb114000000008b483045022009538bca3258eb4175faa7121dca68b51d95f2ed7d24278f03e2d88077d92815022100b8706672c585e8607e18d235e69548cd28736adfa9ce4f8f5f3baffc5aad091b01410445e476b3ea4559019c9f44dc41c103090473ce448f421f0000f2d630a62bb96af64f0fde21c84e4c5a679c43cb7b74e520dad662abfbedc86cc27cc03036c2b0ffffffff7f6d4bbb8f0d9b8bcad2e431c270aac63aa9caaa880dbd1688e39b6ac0d45ff4020000008b48304502203da091fed8fc71b3c859ee1dfe9c3d0e64915502af057357effa1ae4d1e0dbbf02210090fd964dfe7286b1ab0af3e8d6686c7826039eb0b46bac9803af367f080f38e401410445e476b3ea4559019c9f44dc41c103090473ce448f421f0000f2d630a62bb96af64f0fde21c84e4c5a679c43cb7b74e520dad662abfbedc86cc27cc03036c2b0ffffffff0200b79ba7000000001976a914b5ac94f60f833b1e2dab9bc5f7895687bd750e8688acb0720200000000001976a9141b16cf7372a97b42533605e14616b6338caba8e888ac00000000';
        $tx = TransactionFactory::fromHex($hex);
        $header = new BlockHeader(1, Buffer::hex('00000000aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa'), Buffer::hex('12345678aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa'), 1, 1, 1);
        $block = new Block(new Math(), $header, $tx);

        $this->assertEquals($tx->getTxId(), $block->getMerkleRoot());
    }

    public function testFromParser()
    {
        $txHex = '01000000'.
            '01'.
            '0000000000000000000000000000000000000000000000000000000000000000FFFFFFFF'.
            '4D'.
            '04FFFF001D0104455468652054696D65732030332F4A616E2F32303039204368616E63656C6C6F72206F6E206272696E6B206F66207365636F6E64206261696C6F757420666F722062616E6B73'.
            'FFFFFFFF'.
            '01'.
            '00F2052A01000000'.
            '43'.
            '4104678AFDB0FE5548271967F1A67130B7105CD6A828E03909A67962E0EA1F61DEB649F6BC3F4CEF38C4F35504E51EC112DE5C384DF7BA0B8D578A4C702B6BF11D5FAC'.
            '00000000';

        $blockHex = '01000000'.
            '0000000000000000000000000000000000000000000000000000000000000000' .
            '3BA3EDFD7A7B12B27AC72C3E67768F617FC81BC3888A51323A9FB8AA4B1E5E4A' .
            '29AB5F49'.
            'FFFF001D'.
            '1DAC2B7C'.
            '01'.
            $txHex;

        $newBlock = BlockFactory::fromHex($blockHex);

        $this->assertInstanceOf(Block::class, $newBlock);

        $this->assertInternalType('array', $newBlock->getTransactions());
        $this->assertEquals(1, count($newBlock->getTransactions()));
        $this->assertInstanceOf(TransactionInterface::class, $newBlock->getTransaction(0));
        $this->assertEquals($newBlock->getHeader()->getMerkleRoot(), $newBlock->getMerkleRoot());
    }

    public function testFromHex()
    {
        $txHex = '01000000'.
            '01'.
            '0000000000000000000000000000000000000000000000000000000000000000FFFFFFFF'.
            '4D'.
            '04FFFF001D0104455468652054696D65732030332F4A616E2F32303039204368616E63656C6C6F72206F6E206272696E6B206F66207365636F6E64206261696C6F757420666F722062616E6B73'.
            'FFFFFFFF'.
            '01'.
            '00F2052A01000000'.
            '43'.
            '4104678AFDB0FE5548271967F1A67130B7105CD6A828E03909A67962E0EA1F61DEB649F6BC3F4CEF38C4F35504E51EC112DE5C384DF7BA0B8D578A4C702B6BF11D5FAC'.
            '00000000';

        $blockHex = strtolower('01000000'.
            '0000000000000000000000000000000000000000000000000000000000000000' .
            '3BA3EDFD7A7B12B27AC72C3E67768F617FC81BC3888A51323A9FB8AA4B1E5E4A' .
            '29AB5F49'.
            'FFFF001D'.
            '1DAC2B7C'.
            '01'.
            $txHex);

        $newBlock = BlockFactory::fromHex($blockHex);

        $this->assertInstanceOf(Block::class, $newBlock);
        $this->assertEquals($newBlock->getHeader()->getMerkleRoot(), $newBlock->getMerkleRoot());
        $this->assertEquals($blockHex, $newBlock->getHex());
    }

    public function testSerialize()
    {

        $blockHex = strtolower(
            //header
            '01000000'.
            '0000000000000000000000000000000000000000000000000000000000000000' .
            '3BA3EDFD7A7B12B27AC72C3E67768F617FC81BC3888A51323A9FB8AA4B1E5E4A' .
            '29AB5F49'.
            'FFFF001D'.
            '1DAC2B7C'.
            '01'.
            //tx
            '01000000'.
            '01'.
            '0000000000000000000000000000000000000000000000000000000000000000FFFFFFFF'.
            '4D'.
            '04FFFF001D0104455468652054696D65732030332F4A616E2F32303039204368616E63656C6C6F72206F6E206272696E6B206F66207365636F6E64206261696C6F757420666F722062616E6B73'.
            'FFFFFFFF'.
            '01'.
            '00F2052A01000000'.
            '43'.
            '4104678AFDB0FE5548271967F1A67130B7105CD6A828E03909A67962E0EA1F61DEB649F6BC3F4CEF38C4F35504E51EC112DE5C384DF7BA0B8D578A4C702B6BF11D5FAC'.
            '00000000'
        );

        $newBlock = BlockFactory::fromHex($blockHex);
        $this->assertSame($blockHex, $newBlock->getBuffer()->getHex());
    }
}
