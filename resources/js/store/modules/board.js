import axios from "axios";
import router from "../../router";

export default {
    namespaced: true,
    state: () => ({
        boardList: [],
        boardDetail: [],
        userList: [],
        commentList: [],
        user: null,
    }),
    mutations: {
        setBoardList(state, boardList) {
            state.boardList = boardList;
        },
        setBoardDetail(state, boardDetail) {
            state.boardDetail = boardDetail;
        },
        // setBoardListUnshift(state, board) {
        //     state.boardList.unshift(board);
        // },
        setUserList(state, userList) {
            state.userList = userList;
        },
        setCommentList(state, commentList) {
            state.commentList = commentList;
        },
        setUser(state, payload) {
            state.user = payload;
        }


    },
    actions: {
        // 프로젝트 획득
        indexBoard(context, data) {
            const url = '/api/boards/';
            const config = {
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('accessToken'),
                }}
            
            axios.get(url, config)
            .then(response => {
                context.commit('setBoardList', response.data.boardList);
                // console.log('🟢 API 응답 도착:', response.data);
            })
            .catch(error => {
                console.log("API 호출 실패");
                console.log(error);
            });
        },
        // 프로젝트 상태변경
        updateStatus(context, project) {
            const url = `/api/boards/${project.project_id}/status`;
            const config = {
              headers: {
                'Authorization': 'Bearer ' + localStorage.getItem('accessToken'),
                'Content-Type': 'application/json',
              }
            }
          
            axios.post(url, { status: project.status }, config)
              .then(response => {
                console.log("상태 변경 완료", response.data);
              })
              .catch(error => {
                console.error("상태 변경 실패", error);
              });
          },

        // 테스크 상태변경
        updateStatusTask(context, payload) {
            const url = `/api/boards/${payload.project_id}/task/${payload.task_id}/status`;
            const config = {
              headers: {
                'Authorization': 'Bearer ' + localStorage.getItem('accessToken'),
                'Content-Type': 'application/json',
              }
            }
          
            axios.post(url, { status: payload.status }, config)
              .then(response => {
                console.log("상태 변경 완료", response.data);
              })
              .catch(error => {
                console.error("상태 변경 실패", error);
              });
          },

        // 프로젝트 상세(task)
        showBoard(context, id) {
            const url = '/api/boards/' + id;
            const config = {
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('accessToken'),
                }
            }

            axios.get(url, config)
            .then(response => {
                context.commit('setBoardDetail', response.data.boardDetail);
                // console.log(response.data.boardDetail);
            })
            .catch(error => {
                console.log(error);
            }); 
        },
        // 프로젝트 생성
        storeBoard(context, data) {
            const url = '/api/boards/store';
            const config = {
                headers: {
                    'Content-Type': 'multipart/form-data',
                    'Authorization': 'Bearer ' +localStorage.getItem('accessToken'),
                }
            };

            // form data  생성
            const formData = new FormData();
            formData.append('title', data.title);
            formData.append('description', data.description);


            axios.post(url, formData, config)
            .then(response => {
                // context.commit('setBoardListUnshift', response.data.board);
                router.replace('/boards');
            })
            .catch(error => {
                console.log(error);
            });
        },

        // 테스크 작성
        storeTask(context, data) {
            const url =  `/api/boards/${data.project_id}/task`;
            const config = {
                headers: {
                    'Content-Type': 'application/json',
                    'Authorization': 'Bearer ' +localStorage.getItem('accessToken'),
                }
            };

            const payload = {
                project_id: data.project_id,
                content: data.content
            };

            axios.post(url, payload, config)
            .then(response => {
                router.back();
            })
            .catch(error => {
                console.log(error);
            });
        },

        // 프로젝트 수정
        updateBoard(context, data) {
            const url = `/api/boards/${data.project_id}`;
            const config = {
                headers: {
                    'Content-Type': 'application/json',
                    'Authorization': 'Bearer ' +localStorage.getItem('accessToken'),
                }
            };

            const payload = {
                title: data.title,
                description: data.description
            };

            axios.put(url, payload, config)
            .then(response => {
                alert('프로젝트가 수정되었습니다.');
                router.replace('/boards');
            })
            .catch(error => {
                alert('수정 중 오류가 발생했습니다.');
                console.log(error.response.data.errors);
            });

        },

        // 프로젝트 삭제
        DeleteBoard(context, data) {
            if(!confirm('프로젝트를 삭제하시겠습니까?')) {
                return;
            }
            const url = `/api/boards/${data.project_id}`;
            const config = {
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('accessToken'),
                }
            }
            axios.delete(url, config)
            .then(response => {
                alert('프로젝트 삭제');			
            })
            .catch(error => {
                console.error(error);
            });
		},
        // 사용자 페이지
        indexUser(context, data) {
            const url = '/api/users/';
            const config = {
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('accessToken'),
                }}
            
            axios.get(url, config)
            .then(response => {
                context.commit('setUserList', response.data.userList);
                // console.log('API 응답 도착:', response.data.userList);
            })
            .catch(error => {
                console.log(error);
                if (error.response && error.response.status === 403) {
                    alert('관리자만 접근할 수 있습니다.');
                    router.push('/boards');
                } else {
                    console.error('사용자 목록 요청 실패:', error);
                }
            });
        },

        // 댓글 출력
        indexComment(context, data) {
            const url = `/api/boards/${data.project_id}/comments`;
            const config = {
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('accessToken'),
                }}
            
            axios.get(url, config)
            .then(response => {
                console.log('댓글 응답 도착:', response.data);
                context.commit('setCommentList', response.data.commentList);
            })
            .catch(error => {
                console.log("API 호출 실패");
                console.log(error);
            });
        },

        // 댓글 작성
        storeComment(context, data) {
            const url =  `/api/boards/${data.project_id}/comments/store`;
            const config = {
                headers: {
                    'Content-Type': 'application/json',
                    'Authorization': 'Bearer ' +localStorage.getItem('accessToken'),
                }
            };

            const payload = {
                project_id: data.project_id,
                comment: data.comment
            };

            axios.post(url, payload, config)
            .then(response => {
                alert('댓글을 작성하였습니다.');
                location.reload(true);
            })
            .catch(error => {
                console.log(error);
            });
        },


    },
    getters: {
        isAdmin: (state) => state.user?.is_admin === true
    }
}