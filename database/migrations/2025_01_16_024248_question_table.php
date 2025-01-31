<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('question', function (Blueprint $table) {
            $table->id();//ข้อคำถาม
            $table->string('question_name');//คำถาม
            $table->enum('question_status',['on','off'])->default('on');
            $table->string('question_multiply', 10)->nullable();//คะเเนนรวม
            $table->timestamps();
        });

        Schema::create('evaluation_component', function (Blueprint $table) {
            $table->id();//ข้อคำถาม
            $table->string('component_name');//คำถาม
            $table->enum('component_status',['on','off'])->default('on');
            $table->string('weight_score', 10)->nullable();
            $table->timestamps();
        });

        Schema::create('personal_score', function (Blueprint $table) {
            $table->id();
            $table->integer('personal_num');//ชื่อผู้ถูกประเมิน
            $table->text('question_num');//ทำถาม
            $table->text('score');//คะเเนนทุกจ้อ
            $table->string('total_score', 10);//คะเเนนรวม
            $table->integer('points')->nullable();//คะเเนนรวม
            $table->integer('user_num');//ผู้ประเมิน
            $table->integer('round')->nullable();//ผู้ประเมิน
            $table->timestamps();
        });

        Schema::create('assessment_acknowledgement', function (Blueprint $table) {
            $table->id();
            $table->string('assessment_acknowledgement_name');
            $table->enum('assessment_acknowledgement_status',['on','off'])->default('on');
            $table->timestamps();
        });

        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->string('comment_name');
            $table->enum('comment_status',['on','off'])->default('on');
            $table->timestamps();
        });

        Schema::create('criterion', function (Blueprint $table) {
            $table->id();
            $table->string('criterion_name');
            $table->enum('criterion_status',['on','off'])->default('on');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // เพิ่มตารางที่จะสร้างตรงนี้

        Schema::dropIfExists('question');//ตัวอย่าง!!
        Schema::dropIfExists('personal_score');
        Schema::dropIfExists('evaluation_component');
        Schema::dropIfExists('assessment_acknowledgement');
        Schema::dropIfExists('comments');
        Schema::dropIfExists('criterion');

        //ใช้คำสั่ง php artisan migrate ใน terminal หากใช้ xampp ในการรัน server หรือ ใช้คำสั่ง ./vendor/bin/sail artisan migrate ใน ubuntu หากใช้ docker ในการรัน server
    }
};
