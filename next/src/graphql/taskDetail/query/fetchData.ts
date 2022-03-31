import { gql } from '@apollo/client';
import type { Task } from 'models/task';
import { TaskStatus } from 'models/task_status';

export const FETCH_TASK_DETAIL_DATA = gql`
  query FetchTaskDetailData($id: ID!) {
    task(id: $id) {
      id
      task_status {
        id
        status
      }
      text
      title
    }
    task_statuses {
      id
      status
    }
  }
`;

export interface TaskDetailData {
  task: Task[];
  task_statuses: TaskStatus[];
}
